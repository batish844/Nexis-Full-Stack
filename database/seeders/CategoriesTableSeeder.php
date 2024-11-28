<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['Name' => 'Bottoms', 'Gender' => 'M'],
            ['Name' => 'Tops', 'Gender' => 'M'],
            ['Name' => 'Shoes', 'Gender' => 'M'],
            ['Name' => 'Sweatpants', 'Gender' => 'M'],
            ['Name' => 'Bottoms', 'Gender' => 'F'],
            ['Name' => 'Tops', 'Gender' => 'F'],
            ['Name' => 'Shoes', 'Gender' => 'F'],
            ['Name' => 'Dresses', 'Gender' => 'F'],
        ];

        foreach ($categories as $category) {
            DB::table('Categories')->insert([
                'Name'       => $category['Name'],
                'Gender'     => $category['Gender'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
