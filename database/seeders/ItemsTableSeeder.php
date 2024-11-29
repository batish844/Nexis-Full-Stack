<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // CategoryID 1 - Men Bottoms
            [
                'CategoryID'    => 1,
                'name'          => 'Casual Regular Fit Jean Trousers',
                'description'   => 'Fit: Regular, Thickness: Medium Thickness, Product Type: Jean, Fabric: Denim, Material: 100% Cotton, Color: Indigo',
                'price'         => 16.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 4,
                'photo'         => json_encode([
                    "/storage/img/men/bottoms/b1/p1.png",
                    "/storage/img/men/bottoms/b1/p2.png",
                    "/storage/img/men/bottoms/b1/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'name'          => "Skinny Fit Men's Denim Trousers",
                'description'   => 'Waist Fit: Normal Rise, Pattern: Plain, Fit: Skinny, Thickness: Medium Thickness, Product Type: Jean, Leg Fit: Narrowest Leg, Material: Contains High Cotton, Color: Black',
                'price'         => 14.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 4,
                'photo'         => json_encode([
                    "/storage/img/men/bottoms/b2/p1.png",
                    "/storage/img/men/bottoms/b2/p2.png",
                    "/storage/img/men/bottoms/b2/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'name'          => "Skinny Fit Denim Trousers",
                'description'   => 'Waist Fit: Normal Rise, Pattern: Plain, Fit: Skinny, Thickness: Medium Thickness, Product Type: Jean, Fabric: Denim, Leg Fit: Narrowest Leg, Color: Grey',
                'price'         => 20.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 4,
                'photo'         => json_encode([
                    "/storage/img/men/bottoms/b3/p1.png",
                    "/storage/img/men/bottoms/b3/p2.png",
                    "/storage/img/men/bottoms/b3/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'name'          => "Regular Fit Men Denim Trousers",
                'description'   => 'Fit: Regular, Thickness: Medium Thickness, Product Type: Jean, Fabric: Denim, Material: 100% Cotton, Color: Indigo',
                'price'         => 19.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 4,
                'photo'         => json_encode([
                    "/storage/img/men/bottoms/b4/p1.png",
                    "/storage/img/men/bottoms/b4/p2.png",
                    "/storage/img/men/bottoms/b4/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'name'          => "Jeans Regular Fit Men Jeans",
                'description'   => 'Fit: Regular, Thickness: Medium Thickness, Product Type: Jean, Material: Contains High Cotton, Color: Indigo',
                'price'         => 17.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 4,
                'photo'         => json_encode([
                    "/storage/img/men/bottoms/b5/p1.png",
                    "/storage/img/men/bottoms/b5/p2.png",
                    "/storage/img/men/bottoms/b5/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'name'          => "Jeans Slim Fit Jeans",
                'description'   => 'Fit: Extra Slim, Thickness: Medium Thickness, Product Type: Jean, Material: Contains High Cotton, Color: Indigo',
                'price'         => 17.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 4,
                'photo'         => json_encode([
                    "/storage/img/men/bottoms/b6/p1.png",
                    "/storage/img/men/bottoms/b6/p2.png",
                    "/storage/img/men/bottoms/b6/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'name'          => "Jogger Cargo Jeans",
                'description'   => 'Fit: Pattern: Plain, Fit: Jogger, Thickness: Medium Thickness, Product Type: Jean, Fabric: Denim, Material: 100% Cotton, Color: Anthracite',
                'price'         => 16.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 4,
                'photo'         => json_encode([
                    "/storage/img/men/bottoms/b7/p1.png",
                    "/storage/img/men/bottoms/b7/p2.png",
                    "/storage/img/men/bottoms/b7/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'name'          => "Casual Fit Cargo Pants",
                'description'   => 'Length: Standard, Pattern: Plain, Fit: Comfortable Cut, Thickness: Medium Thickness, Product Type: Cargo Pants, Fabric: Twill, Silhouette: Cargo, Material: 100% Cotton, Color: Grey',
                'price'         => 24.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 4,
                'photo'         => json_encode([
                    "/storage/img/men/bottoms/b8/p1.png",
                    "/storage/img/men/bottoms/b8/p2.png",
                    "/storage/img/men/bottoms/b8/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 2 - Men Tops
            [
                'CategoryID'    => 2,
                'name'          => 'Classic Crew Neck Sweater',
                'description'   => 'Pattern: Color Block, Fit: Regular, Thickness: Thin, Sleeve Length: Long Sleeve, Product Type: Jumper, Collar: Crew Neck, Fabric: Tricot, Material: 100% Cotton, Color: Navy',
                'price'         => 14.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/men/tops/top1/p1.png",
                    "/storage/img/men/tops/top1/p2.png",
                    "/storage/img/men/tops/top1/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'name'          => 'Classic Crew Neck T-shirt',
                'description'   => 'Pattern: Plain, Fit: Loose, Sleeve Length: Short Sleeve, Product Type: T-Shirt, Collar: Crew Neck, Fabric: Combed, Material: 100% Cotton, Color: Anthracite',
                'price'         => 7.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/men/tops/top2/p1.png",
                    "/storage/img/men/tops/top2/p2.png",
                    "/storage/img/men/tops/top2/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'name'          => 'Classic Crew Neck Printed T-Shirt',
                'description'   => 'Pattern: Printed, Fit: Loose, Thickness: Thin, Sleeve Length: Short Sleeve, Product Type: T-Shirt, Collar: Crew Neck, Fabric: Pique, Material: 100% Cotton, Color: Navy',
                'price'         => 6.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/men/tops/top3/p1.png",
                    "/storage/img/men/tops/top3/p2.png",
                    "/storage/img/men/tops/top3/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'name'          => 'Crew Neck Christmas Themed Sweater',
                'description'   => 'Pattern: Patterned, Fit: Regular, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: Jumper, Collar: Crew Neck, Fabric: Tricot, Collection: New Year, Color: Red',
                'price'         => 17.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/men/tops/top4/p1.png",
                    "/storage/img/men/tops/top4/p2.png",
                    "/storage/img/men/tops/top4/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'name'          => 'Crew Neck Printed Sweatshirt',
                'description'   => 'Pattern: Printed, Fit: Loose, Thickness: Thick, Sleeve Length: Long Sleeve, Product Type: Sweatshirt, Collar: Crew Neck, Fabric: Thick Sweatshirt Fabric, Color: Black',
                'price'         => 16.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/men/tops/top5/p1.png",
                    "/storage/img/men/tops/top5/p2.png",
                    "/storage/img/men/tops/top5/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'name'          => 'Crew Neck Printed Sweatshirt',
                'description'   => 'Pattern: Printed, Fit: Loose, Thickness: Thick, Sleeve Length: Long Sleeve, Product Type: Sweatshirt, Collar: Crew Neck, Fabric: 3 Thread Inside Brushed, Color: Brown',
                'price'         => 14.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/men/tops/top6/p1.png",
                    "/storage/img/men/tops/top6/p2.png",
                    "/storage/img/men/tops/top6/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'name'          => 'Regular Fit Velvet Shirt',
                'description'   => 'Pattern: Plain, Fit: Regular, Thickness: Thick, Sleeve Length: Long Sleeve, Product Type: Shirt, Collar: Shirt Collar, Fabric: Velvet, Material: 100% Cotton, Color: Ecru',
                'price'         => 14.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/men/tops/top7/p1.png",
                    "/storage/img/men/tops/top7/p2.png",
                    "/storage/img/men/tops/top7/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'name'          => 'Slim Fit Textured Shirt',
                'description'   => 'Length: Standard, Pattern: Plain, Fit: Slim, Thickness: Thick, Sleeve Length: Long Sleeve, Product Type: Shirt, Collar: Button Shirt Collar, Hoodie Detail: Hoodless, Lining Detail: Without Lining, Color: Grey',
                'price'         => 16.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 20,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/men/tops/top8/p1.png",
                    "/storage/img/men/tops/top8/p2.png",
                    "/storage/img/men/tops/top8/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 3 - Men Shoes
            [
                'CategoryID'    => 3,
                'name'          => 'Trekking Shoes',
                'description'   => 'Back pull ring, Lacing detail, Flexible and comfortable sole, Lining And Inner Sole: TEXTILE MATERIAL (100% POLYESTER), Outer Sole: OTHER MATERIAL (TPR), Upper: OTHER MATERIAL (PVC) TEXTILE MATERIAL (90% POLYESTER 10% ELASTANE), Product Type: Trekking Shoes, Occasion: Casual, Insole Property: EVA, Color: Navy & Grey',
                'price'         => 19.99,
                'size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/men/shoes/s1/p1.png",
                    "/storage/img/men/shoes/s1/p2.png",
                    "/storage/img/men/shoes/s1/p3.png",
                    "/storage/img/men/shoes/s1/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'name'          => 'NAVY Classic Shoes',
                'description'   => 'Lining: TEXTILE MATERIAL, Outer Sole: OTHER MATERIAL (TPR), Upper: OTHER MATERIAL (POLYURETHANE), Product Type: Classic Shoes, Color: Navy',
                'price'         => 19.95,
                'size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/men/shoes/s2/p1.png",
                    "/storage/img/men/shoes/s2/p2.png",
                    "/storage/img/men/shoes/s2/p3.png",
                    "/storage/img/men/shoes/s2/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'name'          => 'Suede Look Classic Shoes',
                'description'   => 'Pattern: Plain, Product Type: Classic Shoes, Toe Style: Round Toe, Shoe Closing Style: Shoestring, Color: Brown',
                'price'         => 19.99,
                'size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/men/shoes/s3/p1.png",
                    "/storage/img/men/shoes/s3/p2.png",
                    "/storage/img/men/shoes/s3/p3.png",
                    "/storage/img/men/shoes/s3/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'name'          => 'Lace-up Trekking Shoes ',
                'description'   => 'Inner Sole: 100% TEXTILE MATERIAL, Lining: 100% TEXTILE MATERIAL, Outer Sole: 100% OTHER MATERIAL (TPR), Upper: 100% OTHER MATERIAL (POLYURETHANE), Pattern: Plain, Product Type: Trekking Shoes, Toe Style: Round Toe, Color: Anthracite',
                'price'         => 26.99,
                'size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/men/shoes/s4/p1.png",
                    "/storage/img/men/shoes/s4/p2.png",
                    "/storage/img/men/shoes/s4/p3.png",
                    "/storage/img/men/shoes/s4/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'name'          => 'Lace-up Trekking Shoes',
                'description'   => 'Inner Sole: 100% TEXTILE MATERIAL, Lining: 100% TEXTILE MATERIAL, Outer Sole: 100% OTHER MATERIAL (TPR), Upper: 5% TEXTILE MATERIAL 95% OTHER MATERIAL (POLYURETHANE), Pattern: Plain, Product Type: Trekking Shoes, Fabric: Suede, Toe Style: Round Toe, Color: Black',
                'price'         => 29.99,
                'size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/men/shoes/s5/p1.png",
                    "/storage/img/men/shoes/s5/p2.png",
                    "/storage/img/men/shoes/s5/p3.png",
                    "/storage/img/men/shoes/s5/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'name'          => 'Leather Look Lace-Up Boots',
                'description'   => 'Pattern: Plain, Product Type: Boots, Fabric: Imitation Leather, Toe Style: Round Toe, Shoe Closing Style: Shoestring and Zipper, Color: Black',
                'price'         => 29.99,
                'size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/men/shoes/s6/p1.png",
                    "/storage/img/men/shoes/s6/p2.png",
                    "/storage/img/men/shoes/s6/p3.png",
                    "/storage/img/men/shoes/s6/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'name'          => 'Leather Look Classic Shoes',
                'description'   => 'Pattern: Plain, Product Type: Classic Shoes, Fabric: Imitation Leather, Toe Style: Oval Toe, Shoe Closing Style: Shoestring, Color: Black',
                'price'         => 22.99,
                'size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/men/shoes/s7/p1.png",
                    "/storage/img/men/shoes/s7/p2.png",
                    "/storage/img/men/shoes/s7/p3.png",
                    "/storage/img/men/shoes/s7/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'name'          => 'Ankle Boots with Elastic Sides',
                'description'   => 'Wear resistant, Flexible and comfortable sole, Pattern: Plain, Product Type: Boots, Occasion: Casual, Lining Detail: Jersey Lining, Toe Style: Round Toe, Shoe Closing Style: Pull On, Color: Brown',
                'price'         => 32.95,
                'size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/men/shoes/s8/p1.png",
                    "/storage/img/men/shoes/s8/p2.png",
                    "/storage/img/men/shoes/s8/p3.png",
                    "/storage/img/men/shoes/s8/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 4 - Men Sweatpants
            [
                'CategoryID'    => 4,
                'name'          => 'Standard Fit Jogger Sweatpants',
                'description'   => 'Main Fabric: 45% POLYESTER 55% COTTON, Pattern: Plain, Fit: Regular, Thickness: Thick, Product Type: Sweatpants, Fabric: 3 Thread Inside Brushed, Silhouette: Cargo, Color: Grey',
                'price'         => 19.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 15,
                'points'        => 3,
                'photo'         => json_encode([
                    "/storage/img/men/sweatpants-pjs/sw1/p1.png",
                    "/storage/img/men/sweatpants-pjs/sw1/p2.png",
                    "/storage/img/men/sweatpants-pjs/sw1/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'name'          => 'Standard Fit Pajama Bottoms',
                'description'   => 'Pattern: Plaid, Fit: Regular, Product Type: Pyjamas Bottom, Color: Green',
                'price'         => 8.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 15,
                'points'        => 3,
                'photo'         => json_encode([
                    "/storage/img/men/sweatpants-pjs/sw2/p1.png",
                    "/storage/img/men/sweatpants-pjs/sw2/p2.png",
                    "/storage/img/men/sweatpants-pjs/sw2/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'name'          => 'Plaid Pajama Set',
                'description'   => 'Main Fabric Pajamas Bottom: 100% COTTON, Main Fabric Pajamas Top: 31% POLYESTER 69% COTTON, Pattern: Plaid, Fit: Regular, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: Pyjamas Set, Collar: Crew Neck, Color: Red & White',
                'price'         => 16.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 15,
                'points'        => 3,
                'photo'         => json_encode([
                    "/storage/img/men/sweatpants-pjs/sw3/p1.png",
                    "/storage/img/men/sweatpants-pjs/sw3/p2.png",
                    "/storage/img/men/sweatpants-pjs/sw3/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'name'          => 'Standard Fit Polar Pajamas Set',
                'description'   => 'Main Fabric Pajamas Bottom: 100% POLYESTER, Main Fabric Pajamas Top: 100% POLYESTER, Pattern: Striped, Fit: Regular, Thickness: Thick, Sleeve Length: Long Sleeve, Product Type: Pyjamas Set, Collar: Crew Neck, Fabric: Polar, Color: Navy',
                'price'         => 16.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 15,
                'points'        => 3,
                'photo'         => json_encode([
                    "/storage/img/men/sweatpants-pjs/sw4/p1.png",
                    "/storage/img/men/sweatpants-pjs/sw4/p2.png",
                    "/storage/img/men/sweatpants-pjs/sw4/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'name'          => 'Active Sports Elastic Waist Sweatpants',
                'description'   => 'Main Fabric: 42% POLYESTER 58% COTTON, Pattern: Plain, Fit: Regular, Thickness: Thick, Product Type: Sweatpants, Fabric: 3 Thread Inside Brushed, Color: Grey',
                'price'         => 14.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 15,
                'points'        => 3,
                'photo'         => json_encode([
                    "/storage/img/men/sweatpants-pjs/sw5/p1.png",
                    "/storage/img/men/sweatpants-pjs/sw5/p2.png",
                    "/storage/img/men/sweatpants-pjs/sw5/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'name'          => 'ECO Slim Fit Sweatpants',
                'description'   => 'Main Fabric: 31% POLYESTER 69% COTTON, Pattern: Printed, Fit: Slim, Product Type: Sweatpants, Color: Black',
                'price'         => 11.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 15,
                'points'        => 3,
                'photo'         => json_encode([
                    "/storage/img/men/sweatpants-pjs/sw6/p1.png",
                    "/storage/img/men/sweatpants-pjs/sw6/p2.png",
                    "/storage/img/men/sweatpants-pjs/sw6/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'name'          => 'Standard Fit Sweatpants',
                'description'   => 'Main Fabric: 41% POLYESTER 59% COTTON, Pattern: Plain, Fit: Regular, Thickness: Thick, Product Type: Sweatpants, Fabric: 3 Thread Inside Brushed, Color: Beige',
                'price'         => 14.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 15,
                'points'        => 3,
                'photo'         => json_encode([
                    "/storage/img/men/sweatpants-pjs/sw7/p1.png",
                    "/storage/img/men/sweatpants-pjs/sw7/p2.png",
                    "/storage/img/men/sweatpants-pjs/sw7/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'name'          => 'Standard Fit Jogger Sweatpants',
                'description'   => 'Main Fabric: 35% POLYESTER 65% COTTON, Pattern: Plain, Fit: Regular, Thickness: Thick, Product Type: Jogger Sweatpants, Fabric: 3 Thread Inside Brushed, Leg Fit: Elasticated Hem, Color: Green',
                'price'         => 19.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 15,
                'points'        => 3,
                'photo'         => json_encode([
                    "/storage/img/men/sweatpants-pjs/sw8/p1.png",
                    "/storage/img/men/sweatpants-pjs/sw8/p2.png",
                    "/storage/img/men/sweatpants-pjs/sw8/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 5 - Women Bottoms
            [
                'CategoryID'    => 5,
                'name'          => 'Classic BEIGE Skirt',
                'description'   => 'Length: Mid Length, Pattern: Plain, Fit: Slim, Product Type: Skirt, Fabric: Camisole, Lining Detail: Without Lining, Material: Contains High Cotton, Color: Beige',
                'price'         => 16.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/bottoms/b1/p1.png",
                    "/storage/img/women/bottoms/b1/p2.png",
                    "/storage/img/women/bottoms/b1/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'name'          => 'BROWN Skirt',
                'description'   => 'Main Fabric: 100% POLYESTER, Length: Mid Length, Pattern: Leopard Print, Fit: Regular, Product Type: Skirt, Lining Detail: Without Lining, Color: Brown Printed',
                'price'         => 14.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/bottoms/b2/p1.png",
                    "/storage/img/women/bottoms/b2/p2.png",
                    "/storage/img/women/bottoms/b2/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'name'          => 'Classic GREY Skirt',
                'description'   => 'Length: Mid Length, Pattern: Plain, Fit: Slim, Thickness: Thick, Product Type: Skirt, Fabric: Tricot, Lining Detail: Without Lining, Color: Light Grey',
                'price'         => 9.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/bottoms/b3/p1.png",
                    "/storage/img/women/bottoms/b3/p2.png",
                    "/storage/img/women/bottoms/b3/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'name'          => 'Elastic Waist Printed Jogger Sweatpants',
                'description'   => 'Pattern: Printed, Fit: Loose, Thickness: Medium Thickness, Product Type: Jogger Sweatpants, Fabric: 2 Thread Inside Brushed, Leg Fit: Elasticated Hem, Color: Green',
                'price'         => 9.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/bottoms/b4/p1.png",
                    "/storage/img/women/bottoms/b4/p2.png",
                    "/storage/img/women/bottoms/b4/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'name'          => 'Elastic Waist Jogger Sweatpants',
                'description'   => 'Pattern: Plain, Fit: Regular, Thickness: Medium Thickness, Product Type: Jogger Sweatpants, Fabric: Interlock, Leg Fit: Elasticated Hem, Collection: Big Size, Color: Anthracite',
                'price'         => 16.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/bottoms/b5/p1.png",
                    "/storage/img/women/bottoms/b5/p2.png",
                    "/storage/img/women/bottoms/b5/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'name'          => 'Straight Fit Shiny Jeans',
                'description'   => 'Pattern: Plain, Fit: Straight, Thickness: Medium Thickness, Product Type: Jean, Fabric: Denim, Material: 100% Cotton, Color: Indigo',
                'price'         => 14.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/bottoms/b6/p1.png",
                    "/storage/img/women/bottoms/b6/p2.png",
                    "/storage/img/women/bottoms/b6/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'name'          => 'Wideleg Cargo Jean Pants',
                'description'   => 'Fit: Regular, Product Type: Jean, Material: 100% Cotton, Color: Indigo',
                'price'         => 19.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/bottoms/b7/p1.png",
                    "/storage/img/women/bottoms/b7/p2.png",
                    "/storage/img/women/bottoms/b7/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'name'          => 'Wideleg Jeans',
                'description'   => 'Pattern: Plain, Fit: Wideleg, Thickness: Medium Thickness, Product Type: Jean, Fabric: Denim, Leg Fit: Wide Leg, Material: 100% Cotton, Color: Black',
                'price'         => 19.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/bottoms/b8/p1.png",
                    "/storage/img/women/bottoms/b8/p2.png",
                    "/storage/img/women/bottoms/b8/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 6 - Women Shoes
            [
                'CategoryID'    => 6,
                'name'          => 'Crew Neck Polka Dot T-Shirt',
                'description'   => 'Main Fabric: 3% ELASTANE/SPANDEX 16% POLYESTER 81% VISCOSE/RAYON, Pattern: Polka Dot, Fit: Slim, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: T-Shirt, Collar: Crew Neck, Fabric: Combed, Collection: Big Size, Color: Black Printed',
                'price'         => 9.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/tops/top1/p1.png",
                    "/storage/img/women/tops/top1/p2.png",
                    "/storage/img/women/tops/top1/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'name'          => 'Crew Neck Oversized T-Shirt',
                'description'   => 'Main Fabric: 100% COTTON, Pattern: Printed, Fit: Oversize, Thickness: Thin, Sleeve Length: Short Sleeve, Product Type: T-Shirt, Collar: Crew Neck, Fabric: Combed, Color: Navy',
                'price'         => 6.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/tops/top2/p1.png",
                    "/storage/img/women/tops/top2/p2.png",
                    "/storage/img/women/tops/top2/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'name'          => 'Crew Neck Printed T-shirt',
                'description'   => 'Pattern: Printed, Fit: Loose, Thickness: Thin, Sleeve Length: Short Sleeve, Product Type: T-Shirt, Collar: Crew Neck, Fabric: Combed, Material: 100% Cotton, Color: White',
                'price'         => 6.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/tops/top3/p1.png",
                    "/storage/img/women/tops/top3/p2.png",
                    "/storage/img/women/tops/top3/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'name'          => 'Crew Neck Striped T-shirt',
                'description'   => 'Pattern: Striped, Fit: Regular, Thickness: Thin, Sleeve Length: Long Sleeve, Product Type: T-Shirt, Collar: Crew Neck, Fabric: Combed, Occasion: Casual, Color: Anthracite Striped',
                'price'         => 9.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/tops/top4/p1.png",
                    "/storage/img/women/tops/top4/p2.png",
                    "/storage/img/women/tops/top4/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'name'          => 'Shirt Collar Striped Shirt',
                'description'   => 'Main Fabric: 14% POLYAMIDE/NYLON 86% VISCOSE/RAYON, Fit: Regular, Product Type: Shirt, Color: Black Striped',
                'price'         => 12.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/tops/top5/p1.png",
                    "/storage/img/women/tops/top5/p2.png",
                    "/storage/img/women/tops/top5/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'name'          => 'Square Neck Straight Body',
                'description'   => 'Main Fabric: 7% ELASTANE/SPANDEX 93% POLYAMIDE, Pattern: Plain, Fit: Extra Slim, Thickness: Thin, Sleeve Length: Long Sleeve, Product Type: Body, Collar: Square Collar, Silhouette: Bodycon, Collection: Big Size, Color: Grey',
                'price'         => 9.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/tops/top6/p1.png",
                    "/storage/img/women/tops/top6/p2.png",
                    "/storage/img/women/tops/top6/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'name'          => 'V Neck Printed T-shirt',
                'description'   => 'Main Fabric: 4% ELASTANE/SPANDEX 96% VISCOSE/RAYON, Pattern: Printed, Fit: Regular, Thickness: Thin, Sleeve Length: Long Sleeve, Product Type: T-Shirt, Collar: V Neck, Fabric: Combed, Collection: Big Size, Color: Navy',
                'price'         => 9.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/tops/top7/p1.png",
                    "/storage/img/women/tops/top7/p2.png",
                    "/storage/img/women/tops/top7/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'name'          => 'Polo Neck T-Shirt',
                'description'   => 'Main Fabric: 1% ELASTANE/SPANDEX 17% POLYESTER 82% COTTON, Fit: Regular, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: T-Shirt, Collar: Shirt Collar, Material: Contains High Cotton, Color: Pink',
                'price'         => 10.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 5,
                'photo'         => json_encode([
                    "/storage/img/women/tops/top8/p1.png",
                    "/storage/img/women/tops/top8/p2.png",
                    "/storage/img/women/tops/top8/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 7 - Women Shoes
            [
                'CategoryID'    => 7,
                'name'          => 'Straw Wedge Heeled Shoes',
                'description'   => 'Pattern: Plain, Product Type: High Heels, Fabric: Mat, Toe Style: Round Toe, Heel Height: 5 cm, Shoe Closing Style: Buckle, Heel Style: Wedge Heel, Color: Khaki',
                'price'         => 24.95,
                'size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/women/shoes/s1/p1.png",
                    "/storage/img/women/shoes/s1/p2.png",
                    "/storage/img/women/shoes/s1/p3.png",
                    "/storage/img/women/shoes/s1/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'name'          => 'Lace-Up Ankle-Size Sneaker',
                'description'   => 'Pattern: Plain, Product Type: Sneakers, Toe Style: Round Toe, Shoe Closing Style: Shoestring, Color: Mix Printed (White & Camel)',
                'price'         => 19.99,
                'size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/women/shoes/s2/p1.png",
                    "/storage/img/women/shoes/s2/p2.png",
                    "/storage/img/women/shoes/s2/p3.png",
                    "/storage/img/women/shoes/s2/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'name'          => 'Leather Look Classic Shoes',
                'description'   => 'Pattern: Plain, Product Type: Classic Shoes, Toe Style: Oval Toe, Shoe Closing Style: Pull On, Color: Black',
                'price'         => 6.99,
                'size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/women/shoes/s3/p1.png",
                    "/storage/img/women/shoes/s3/p2.png",
                    "/storage/img/women/shoes/s3/p3.png",
                    "/storage/img/women/shoes/s3/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'name'          => 'Mesh Detailed Sneakers',
                'description'   => 'Pattern: Plain, Product Type: Sneakers, Fabric: Tricot, Toe Style: Round Toe, Shoe Closing Style: Shoestring, Color: Beige',
                'price'         => 16.99,
                'size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/women/shoes/s4/p1.png",
                    "/storage/img/women/shoes/s4/p2.png",
                    "/storage/img/women/shoes/s4/p3.png",
                    "/storage/img/women/shoes/s4/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'name'          => 'Pointed Toe Leather Look Flats',
                'description'   => 'Pattern: Patterned, Product Type: Flats, Fabric: Imitation Leather, Toe Style: Pointy toe, Color: Beige',
                'price'         => 9.99,
                'size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/women/shoes/s5/p1.png",
                    "/storage/img/women/shoes/s5/p2.png",
                    "/storage/img/women/shoes/s5/p3.png",
                    "/storage/img/women/shoes/s5/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'name'          => 'Lace-Up and Zipper Boots',
                'description'   => 'Pattern: Plain, Product Type: Boots, Fabric: Imitation Leather, Toe Style: Round Toe, Shoe Closing Style: Shoestring and Zipper, Color: Black',
                'price'         => 29.99,
                'size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/women/shoes/s6/p1.png",
                    "/storage/img/women/shoes/s6/p2.png",
                    "/storage/img/women/shoes/s6/p3.png",
                    "/storage/img/women/shoes/s6/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'name'          => 'Lace-Up Sneakers',
                'description'   => 'Pattern: Plain, Product Type: Sneakers, Fabric: Canvas, Toe Style: Round Toe, Heel Height: 3 cm, Shoe Closing Style: Shoestring, Color: Black',
                'price'         => 19.95,
                'size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/women/shoes/s7/p1.png",
                    "/storage/img/women/shoes/s7/p2.png",
                    "/storage/img/women/shoes/s7/p3.png",
                    "/storage/img/women/shoes/s7/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'name'          => 'Lace-Up Sneakers',
                'description'   => 'Inner Sole: 100% TEXTILE MATERIAL, Lining: 100% TEXTILE MATERIAL, Outer Sole: 100% OTHER MATERIAL (PVC), Upper: 50% OTHER MATERIAL (POLYURETHANE) 50% TEXTILE MATERIAL, Pattern: Patterned, Product Type: Sneakers, Toe Style: Round Toe, Shoe Closing Style: Shoestring, Color: Buxe White',
                'price'         => 29.99,
                'size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'quantity'      => 10,
                'points'        => 6,
                'photo'         => json_encode([
                    "/storage/img/women/shoes/s8/p1.png",
                    "/storage/img/women/shoes/s8/p2.png",
                    "/storage/img/women/shoes/s8/p3.png",
                    "/storage/img/women/shoes/s8/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 8 - Women Dresses
            [
                'CategoryID'    => 8,
                'name'          => 'BROWN Shirt Dress',
                'description'   => 'Length: Long, Pattern: Plain, Fit: Loose, Sleeve Length: Long Sleeve, Product Type: Shirt Dress, Collar: Shirt Collar, Fabric: Viscone, Lining Detail: Without Lining, Product Additional Accessory: Sash, Color: Brown',
                'price'         => 19.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 8,
                'photo'         => json_encode([
                    "/storage/img/women/dresses/d1/p1.png",
                    "/storage/img/women/dresses/d1/p2.png",
                    "/storage/img/women/dresses/d1/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'name'          => 'Crew Neck Plaid Shirt Dress',
                'description'   => 'Length: Long, Pattern: Plaid, Fit: Regular, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: Shirt Dress, Collar: Crew Neck, Fabric: Twill, Lining Detail: Without Lining, Color: Red & Black',
                'price'         => 17.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 8,
                'photo'         => json_encode([
                    "/storage/img/women/dresses/d2/p1.png",
                    "/storage/img/women/dresses/d2/p2.png",
                    "/storage/img/women/dresses/d2/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'name'          => 'Crew Neck Dress',
                'description'   => 'Length: Long, Pattern: Plain, Fit: Slim, Sleeve Length: Long Sleeve, Product Type: Dress, Collar: Crew Neck, Lining Detail: Without Lining, Color: Dark Green',
                'price'         => 11.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 8,
                'photo'         => json_encode([
                    "/storage/img/women/dresses/d3/p1.png",
                    "/storage/img/women/dresses/d3/p2.png",
                    "/storage/img/women/dresses/d3/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'name'          => 'ECRU Dress',
                'description'   => 'Length: Mid Length, Pattern: Color Block, Fit: Loose, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: Dress, Collar: Turtleneck / Mock Turtleneck, Fabric: Tricot, Lining Detail: Without Lining, Color: Ecru & Black',
                'price'         => 14.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 8,
                'photo'         => json_encode([
                    "/storage/img/women/dresses/d4/p1.png",
                    "/storage/img/women/dresses/d4/p2.png",
                    "/storage/img/women/dresses/d4/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'name'          => 'Modest Crew Neck Dress',
                'description'   => 'Length: Long, Pattern: Plain, Fit: Standard, Thickness: Thin, Sleeve Length: Long Sleeve, Product Type: Dress, Collar: Crew Neck, Lining Detail: Without Lining, Collection: Hijab Clothing, Color: Black',
                'price'         => 15.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 8,
                'photo'         => json_encode([
                    "/storage/img/women/dresses/d5/p1.png",
                    "/storage/img/women/dresses/d5/p2.png",
                    "/storage/img/women/dresses/d5/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'name'          => 'Patterned Waist Belted Shirt Dress',
                'description'   => 'Length: Long, Pattern: Printed, Fit: Regular, Sleeve Length: Long Sleeve, Product Type: Shirt Dress, Collar: Shirt Collar, Fabric: Viscone, Color: Green',
                'price'         => 29.95,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 8,
                'photo'         => json_encode([
                    "/storage/img/women/dresses/d6/p1.png",
                    "/storage/img/women/dresses/d6/p2.png",
                    "/storage/img/women/dresses/d6/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'name'          => 'Patterned Shirt Dress',
                'description'   => 'Length: Long, Pattern: Patterned, Fit: Loose, Thickness: Thin, Sleeve Length: Long Sleeve, Product Type: Shirt Dress, Collar: Shirt Collar, Lining Detail: Without Lining, Product Additional Accessory: Sash, Color: Navy',
                'price'         => 19.95,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 8,
                'photo'         => json_encode([
                    "/storage/img/women/dresses/d7/p1.png",
                    "/storage/img/women/dresses/d7/p2.png",
                    "/storage/img/women/dresses/d7/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'name'          => 'Patterned Shirt Dress',
                'description'   => 'Length: Long, Pattern: Patterned, Fit: Regular, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: Shirt Dress, Collar: Shirt Collar, Lining Detail: Without Lining, Product Additional Accessory: Sash, Collection: Big Size, Color: Mix Printed(Navy, Beige & Camel)',
                'price'         => 22.99,
                'size'          => json_encode(["S", "M", "L", "XL"]),
                'quantity'      => 10,
                'points'        => 8,
                'photo'         => json_encode([
                    "/storage/img/women/dresses/d8/p1.png",
                    "/storage/img/women/dresses/d8/p2.png",
                    "/storage/img/women/dresses/d8/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

        ];

        // Insert items in chunks to optimize performance
        foreach (array_chunk($items, 100) as $chunk) {
            DB::table('items')->insert($chunk);
        }
    }
}