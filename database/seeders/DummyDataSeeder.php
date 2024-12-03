<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create new users and collect their UserIDs
        $newUserIDs = [];

        foreach (range(1, 5) as $index) {
            $userID = DB::table('users')->insertGetId([
                // Do not specify 'UserID'; let the database handle it
                'First_Name' => $faker->firstName,
                'Last_Name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Default password
                'created_at' => now(),
                'updated_at' => now(),
            ], 'UserID'); // Specify the primary key column

            $newUserIDs[] = $userID;
        }

        // Delete data from order_items and orders tables in the correct order
        DB::table('order_items')->delete();
        DB::table('orders')->delete();

        // Reset the auto-increment IDs if needed (optional)
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE order_items AUTO_INCREMENT = 1;');
            DB::statement('ALTER TABLE orders AUTO_INCREMENT = 1;');
        } elseif (DB::getDriverName() === 'pgsql') {
            // For PostgreSQL, reset sequence
            DB::statement("SELECT setval(pg_get_serial_sequence('orders', 'OrderID'), 1, false);");
            DB::statement("SELECT setval(pg_get_serial_sequence('order_items', 'id'), 1, false);");
        }

        // Seed Orders
        foreach (range(1, 30) as $index) {
            $orderID = DB::table('orders')->insertGetId([
                // Do not specify 'OrderID'; let the database handle it
                'Status' => $faker->randomElement(['Pending', 'Processing', 'Completed', 'Cancelled']),
                'TotalPrice' => 0, // Initially 0; will be updated dynamically
                'OrderedBy' => $faker->randomElement($newUserIDs), // Use new users only
                'created_at' => $faker->dateTimeBetween('-2 months', 'now'),
                'updated_at' => now(),
            ], 'OrderID'); // Specify the primary key column

            $totalPrice = 0;

            // Seed Order Items
            foreach (range(1, $faker->numberBetween(1, 5)) as $itemIndex) {
                $itemID = $faker->numberBetween(1, 64); // Valid item IDs
                $item = DB::table('items')->where('ItemID', $itemID)->first();

                if (!$item) {
                    continue; // Skip if item doesn't exist
                }

                $quantity = $faker->numberBetween(1, 9); // Max quantity = 9
                $price = $item->Price;
                $subtotal = $price * $quantity;

                // Assign size based on category
                $size = in_array($item->CategoryID, [3, 7])
                    ? $faker->numberBetween(39, 49) // Sizes 39 to 49
                    : $faker->randomElement(['S', 'M', 'L', 'XL']); // Sizes S, M, L, XL

                $totalPrice += $subtotal;

                DB::table('order_items')->insert([
                    'OrderID' => $orderID,
                    'ItemID' => $itemID,
                    'Size' => $size,
                    'Quantity' => $quantity,
                    'TotalPrice' => $subtotal,
                    'created_at' => $faker->dateTimeBetween('-2 months', 'now'),
                    'updated_at' => now(),
                ]);
            }

            // Update the order's total price
            DB::table('orders')->where('OrderID', $orderID)->update(['TotalPrice' => $totalPrice]);
        }
    }
}
