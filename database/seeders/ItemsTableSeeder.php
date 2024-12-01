<?php

Namespace Database\Seeders;

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
                'Name'          => 'Casual Regular Fit Jean Trousers',
                'Description'   => 'Fit: Regular, Thickness: Medium Thickness, Product Type: Jean, Fabric: Denim, Material: 100% Cotton, Color: Indigo',
                'Price'         => 16.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 4,
                'Photo'         => json_encode([
                    "img/men/bottoms/b1/p1.png",
                    "img/men/bottoms/b1/p2.png",
                    "img/men/bottoms/b1/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'Name'          => "Skinny Fit Men's Denim Trousers",
                'Description'   => 'Waist Fit: Normal Rise, Pattern: Plain, Fit: Skinny, Thickness: Medium Thickness, Product Type: Jean, Leg Fit: Narrowest Leg, Material: Contains High Cotton, Color: Black',
                'Price'         => 14.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 4,
                'Photo'         => json_encode([
                    "img/men/bottoms/b2/p1.png",
                    "img/men/bottoms/b2/p2.png",
                    "img/men/bottoms/b2/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'Name'          => "Skinny Fit Denim Trousers",
                'Description'   => 'Waist Fit: Normal Rise, Pattern: Plain, Fit: Skinny, Thickness: Medium Thickness, Product Type: Jean, Fabric: Denim, Leg Fit: Narrowest Leg, Color: Grey',
                'Price'         => 20.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 4,
                'Photo'         => json_encode([
                    "img/men/bottoms/b3/p1.png",
                    "img/men/bottoms/b3/p2.png",
                    "img/men/bottoms/b3/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'Name'          => "Regular Fit Men Denim Trousers",
                'Description'   => 'Fit: Regular, Thickness: Medium Thickness, Product Type: Jean, Fabric: Denim, Material: 100% Cotton, Color: Indigo',
                'Price'         => 19.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 4,
                'Photo'         => json_encode([
                    "img/men/bottoms/b4/p1.png",
                    "img/men/bottoms/b4/p2.png",
                    "img/men/bottoms/b4/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'Name'          => "Jeans Regular Fit Men Jeans",
                'Description'   => 'Fit: Regular, Thickness: Medium Thickness, Product Type: Jean, Material: Contains High Cotton, Color: Indigo',
                'Price'         => 17.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 4,
                'Photo'         => json_encode([
                    "img/men/bottoms/b5/p1.png",
                    "img/men/bottoms/b5/p2.png",
                    "img/men/bottoms/b5/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'Name'          => "Jeans Slim Fit Jeans",
                'Description'   => 'Fit: Extra Slim, Thickness: Medium Thickness, Product Type: Jean, Material: Contains High Cotton, Color: Indigo',
                'Price'         => 17.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 4,
                'Photo'         => json_encode([
                    "img/men/bottoms/b6/p1.png",
                    "img/men/bottoms/b6/p2.png",
                    "img/men/bottoms/b6/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'Name'          => "Jogger Cargo Jeans",
                'Description'   => 'Fit: Pattern: Plain, Fit: Jogger, Thickness: Medium Thickness, Product Type: Jean, Fabric: Denim, Material: 100% Cotton, Color: Anthracite',
                'Price'         => 16.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 4,
                'Photo'         => json_encode([
                    "img/men/bottoms/b7/p1.png",
                    "img/men/bottoms/b7/p2.png",
                    "img/men/bottoms/b7/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 1,
                'Name'          => "Casual Fit Cargo Pants",
                'Description'   => 'Length: Standard, Pattern: Plain, Fit: Comfortable Cut, Thickness: Medium Thickness, Product Type: Cargo Pants, Fabric: Twill, Silhouette: Cargo, Material: 100% Cotton, Color: Grey',
                'Price'         => 24.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 4,
                'Photo'         => json_encode([
                    "img/men/bottoms/b8/p1.png",
                    "img/men/bottoms/b8/p2.png",
                    "img/men/bottoms/b8/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 2 - Men Tops
            [
                'CategoryID'    => 2,
                'Name'          => 'Classic Crew Neck Sweater',
                'Description'   => 'Pattern: Color Block, Fit: Regular, Thickness: Thin, Sleeve Length: Long Sleeve, Product Type: Jumper, Collar: Crew Neck, Fabric: Tricot, Material: 100% Cotton, Color: Navy',
                'Price'         => 14.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/men/tops/top1/p1.png",
                    "img/men/tops/top1/p2.png",
                    "img/men/tops/top1/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'Name'          => 'Classic Crew Neck T-shirt',
                'Description'   => 'Pattern: Plain, Fit: Loose, Sleeve Length: Short Sleeve, Product Type: T-Shirt, Collar: Crew Neck, Fabric: Combed, Material: 100% Cotton, Color: Anthracite',
                'Price'         => 7.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/men/tops/top2/p1.png",
                    "img/men/tops/top2/p2.png",
                    "img/men/tops/top2/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'Name'          => 'Classic Crew Neck Printed T-Shirt',
                'Description'   => 'Pattern: Printed, Fit: Loose, Thickness: Thin, Sleeve Length: Short Sleeve, Product Type: T-Shirt, Collar: Crew Neck, Fabric: Pique, Material: 100% Cotton, Color: Navy',
                'Price'         => 6.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/men/tops/top3/p1.png",
                    "img/men/tops/top3/p2.png",
                    "img/men/tops/top3/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'Name'          => 'Crew Neck Christmas Themed Sweater',
                'Description'   => 'Pattern: Patterned, Fit: Regular, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: Jumper, Collar: Crew Neck, Fabric: Tricot, Collection: New Year, Color: Red',
                'Price'         => 17.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/men/tops/top4/p1.png",
                    "img/men/tops/top4/p2.png",
                    "img/men/tops/top4/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'Name'          => 'Crew Neck Printed Sweatshirt',
                'Description'   => 'Pattern: Printed, Fit: Loose, Thickness: Thick, Sleeve Length: Long Sleeve, Product Type: Sweatshirt, Collar: Crew Neck, Fabric: Thick Sweatshirt Fabric, Color: Black',
                'Price'         => 16.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/men/tops/top5/p1.png",
                    "img/men/tops/top5/p2.png",
                    "img/men/tops/top5/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'Name'          => 'Crew Neck Printed Sweatshirt',
                'Description'   => 'Pattern: Printed, Fit: Loose, Thickness: Thick, Sleeve Length: Long Sleeve, Product Type: Sweatshirt, Collar: Crew Neck, Fabric: 3 Thread Inside Brushed, Color: Brown',
                'Price'         => 14.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/men/tops/top6/p1.png",
                    "img/men/tops/top6/p2.png",
                    "img/men/tops/top6/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'Name'          => 'Regular Fit Velvet Shirt',
                'Description'   => 'Pattern: Plain, Fit: Regular, Thickness: Thick, Sleeve Length: Long Sleeve, Product Type: Shirt, Collar: Shirt Collar, Fabric: Velvet, Material: 100% Cotton, Color: Ecru',
                'Price'         => 14.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/men/tops/top7/p1.png",
                    "img/men/tops/top7/p2.png",
                    "img/men/tops/top7/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 2,
                'Name'          => 'Slim Fit Textured Shirt',
                'Description'   => 'Length: Standard, Pattern: Plain, Fit: Slim, Thickness: Thick, Sleeve Length: Long Sleeve, Product Type: Shirt, Collar: Button Shirt Collar, Hoodie Detail: Hoodless, Lining Detail: Without Lining, Color: Grey',
                'Price'         => 16.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 20,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/men/tops/top8/p1.png",
                    "img/men/tops/top8/p2.png",
                    "img/men/tops/top8/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 3 - Men Shoes
            [
                'CategoryID'    => 3,
                'Name'          => 'Trekking Shoes',
                'Description'   => 'Back pull ring, Lacing detail, Flexible and comfortable sole, Lining And Inner Sole: TEXTILE MATERIAL (100% POLYESTER), Outer Sole: OTHER MATERIAL (TPR), Upper: OTHER MATERIAL (PVC) TEXTILE MATERIAL (90% POLYESTER 10% ELASTANE), Product Type: Trekking Shoes, Occasion: Casual, Insole Property: EVA, Color: Navy & Grey',
                'Price'         => 19.99,
                'Size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/men/shoes/s1/p1.png",
                    "img/men/shoes/s1/p2.png",
                    "img/men/shoes/s1/p3.png",
                    "img/men/shoes/s1/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'Name'          => 'NAVY Classic Shoes',
                'Description'   => 'Lining: TEXTILE MATERIAL, Outer Sole: OTHER MATERIAL (TPR), Upper: OTHER MATERIAL (POLYURETHANE), Product Type: Classic Shoes, Color: Navy',
                'Price'         => 19.95,
                'Size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/men/shoes/s2/p1.png",
                    "img/men/shoes/s2/p2.png",
                    "img/men/shoes/s2/p3.png",
                    "img/men/shoes/s2/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'Name'          => 'Suede Look Classic Shoes',
                'Description'   => 'Pattern: Plain, Product Type: Classic Shoes, Toe Style: Round Toe, Shoe Closing Style: Shoestring, Color: Brown',
                'Price'         => 19.99,
                'Size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/men/shoes/s3/p1.png",
                    "img/men/shoes/s3/p2.png",
                    "img/men/shoes/s3/p3.png",
                    "img/men/shoes/s3/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'Name'          => 'Lace-up Trekking Shoes ',
                'Description'   => 'Inner Sole: 100% TEXTILE MATERIAL, Lining: 100% TEXTILE MATERIAL, Outer Sole: 100% OTHER MATERIAL (TPR), Upper: 100% OTHER MATERIAL (POLYURETHANE), Pattern: Plain, Product Type: Trekking Shoes, Toe Style: Round Toe, Color: Anthracite',
                'Price'         => 26.99,
                'Size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/men/shoes/s4/p1.png",
                    "img/men/shoes/s4/p2.png",
                    "img/men/shoes/s4/p3.png",
                    "img/men/shoes/s4/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'Name'          => 'Lace-up Trekking Shoes',
                'Description'   => 'Inner Sole: 100% TEXTILE MATERIAL, Lining: 100% TEXTILE MATERIAL, Outer Sole: 100% OTHER MATERIAL (TPR), Upper: 5% TEXTILE MATERIAL 95% OTHER MATERIAL (POLYURETHANE), Pattern: Plain, Product Type: Trekking Shoes, Fabric: Suede, Toe Style: Round Toe, Color: Black',
                'Price'         => 29.99,
                'Size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/men/shoes/s5/p1.png",
                    "img/men/shoes/s5/p2.png",
                    "img/men/shoes/s5/p3.png",
                    "img/men/shoes/s5/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'Name'          => 'Leather Look Lace-Up Boots',
                'Description'   => 'Pattern: Plain, Product Type: Boots, Fabric: Imitation Leather, Toe Style: Round Toe, Shoe Closing Style: Shoestring and Zipper, Color: Black',
                'Price'         => 29.99,
                'Size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/men/shoes/s6/p1.png",
                    "img/men/shoes/s6/p2.png",
                    "img/men/shoes/s6/p3.png",
                    "img/men/shoes/s6/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'Name'          => 'Leather Look Classic Shoes',
                'Description'   => 'Pattern: Plain, Product Type: Classic Shoes, Fabric: Imitation Leather, Toe Style: Oval Toe, Shoe Closing Style: Shoestring, Color: Black',
                'Price'         => 22.99,
                'Size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/men/shoes/s7/p1.png",
                    "img/men/shoes/s7/p2.png",
                    "img/men/shoes/s7/p3.png",
                    "img/men/shoes/s7/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 3,
                'Name'          => 'Ankle Boots with Elastic Sides',
                'Description'   => 'Wear resistant, Flexible and comfortable sole, Pattern: Plain, Product Type: Boots, Occasion: Casual, Lining Detail: Jersey Lining, Toe Style: Round Toe, Shoe Closing Style: Pull On, Color: Brown',
                'Price'         => 32.95,
                'Size'          => json_encode([39, 40, 41, 42, 43, 44, 45, 46, 47, 48]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/men/shoes/s8/p1.png",
                    "img/men/shoes/s8/p2.png",
                    "img/men/shoes/s8/p3.png",
                    "img/men/shoes/s8/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 4 - Men Sweatpants
            [
                'CategoryID'    => 4,
                'Name'          => 'Standard Fit Jogger Sweatpants',
                'Description'   => 'Main Fabric: 45% POLYESTER 55% COTTON, Pattern: Plain, Fit: Regular, Thickness: Thick, Product Type: Sweatpants, Fabric: 3 Thread Inside Brushed, Silhouette: Cargo, Color: Grey',
                'Price'         => 19.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 15,
                'Points'        => 3,
                'Photo'         => json_encode([
                    "img/men/sweatpants-pjs/sw1/p1.png",
                    "img/men/sweatpants-pjs/sw1/p2.png",
                    "img/men/sweatpants-pjs/sw1/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'Name'          => 'Standard Fit Pajama Bottoms',
                'Description'   => 'Pattern: Plaid, Fit: Regular, Product Type: Pyjamas Bottom, Color: Green',
                'Price'         => 8.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 15,
                'Points'        => 3,
                'Photo'         => json_encode([
                    "img/men/sweatpants-pjs/sw2/p1.png",
                    "img/men/sweatpants-pjs/sw2/p2.png",
                    "img/men/sweatpants-pjs/sw2/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'Name'          => 'Plaid Pajama Set',
                'Description'   => 'Main Fabric Pajamas Bottom: 100% COTTON, Main Fabric Pajamas Top: 31% POLYESTER 69% COTTON, Pattern: Plaid, Fit: Regular, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: Pyjamas Set, Collar: Crew Neck, Color: Red & White',
                'Price'         => 16.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 15,
                'Points'        => 3,
                'Photo'         => json_encode([
                    "img/men/sweatpants-pjs/sw3/p1.png",
                    "img/men/sweatpants-pjs/sw3/p2.png",
                    "img/men/sweatpants-pjs/sw3/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'Name'          => 'Standard Fit Polar Pajamas Set',
                'Description'   => 'Main Fabric Pajamas Bottom: 100% POLYESTER, Main Fabric Pajamas Top: 100% POLYESTER, Pattern: Striped, Fit: Regular, Thickness: Thick, Sleeve Length: Long Sleeve, Product Type: Pyjamas Set, Collar: Crew Neck, Fabric: Polar, Color: Navy',
                'Price'         => 16.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 15,
                'Points'        => 3,
                'Photo'         => json_encode([
                    "img/men/sweatpants-pjs/sw4/p1.png",
                    "img/men/sweatpants-pjs/sw4/p2.png",
                    "img/men/sweatpants-pjs/sw4/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'Name'          => 'Active Sports Elastic Waist Sweatpants',
                'Description'   => 'Main Fabric: 42% POLYESTER 58% COTTON, Pattern: Plain, Fit: Regular, Thickness: Thick, Product Type: Sweatpants, Fabric: 3 Thread Inside Brushed, Color: Grey',
                'Price'         => 14.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 15,
                'Points'        => 3,
                'Photo'         => json_encode([
                    "img/men/sweatpants-pjs/sw5/p1.png",
                    "img/men/sweatpants-pjs/sw5/p2.png",
                    "img/men/sweatpants-pjs/sw5/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'Name'          => 'ECO Slim Fit Sweatpants',
                'Description'   => 'Main Fabric: 31% POLYESTER 69% COTTON, Pattern: Printed, Fit: Slim, Product Type: Sweatpants, Color: Black',
                'Price'         => 11.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 15,
                'Points'        => 3,
                'Photo'         => json_encode([
                    "img/men/sweatpants-pjs/sw6/p1.png",
                    "img/men/sweatpants-pjs/sw6/p2.png",
                    "img/men/sweatpants-pjs/sw6/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'Name'          => 'Standard Fit Sweatpants',
                'Description'   => 'Main Fabric: 41% POLYESTER 59% COTTON, Pattern: Plain, Fit: Regular, Thickness: Thick, Product Type: Sweatpants, Fabric: 3 Thread Inside Brushed, Color: Beige',
                'Price'         => 14.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 15,
                'Points'        => 3,
                'Photo'         => json_encode([
                    "img/men/sweatpants-pjs/sw7/p1.png",
                    "img/men/sweatpants-pjs/sw7/p2.png",
                    "img/men/sweatpants-pjs/sw7/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 4,
                'Name'          => 'Standard Fit Jogger Sweatpants',
                'Description'   => 'Main Fabric: 35% POLYESTER 65% COTTON, Pattern: Plain, Fit: Regular, Thickness: Thick, Product Type: Jogger Sweatpants, Fabric: 3 Thread Inside Brushed, Leg Fit: Elasticated Hem, Color: Green',
                'Price'         => 19.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 15,
                'Points'        => 3,
                'Photo'         => json_encode([
                    "img/men/sweatpants-pjs/sw8/p1.png",
                    "img/men/sweatpants-pjs/sw8/p2.png",
                    "img/men/sweatpants-pjs/sw8/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 5 - Women Bottoms
            [
                'CategoryID'    => 5,
                'Name'          => 'Classic BEIGE Skirt',
                'Description'   => 'Length: Mid Length, Pattern: Plain, Fit: Slim, Product Type: Skirt, Fabric: Camisole, Lining Detail: Without Lining, Material: Contains High Cotton, Color: Beige',
                'Price'         => 16.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/bottoms/b1/p1.png",
                    "img/women/bottoms/b1/p2.png",
                    "img/women/bottoms/b1/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'Name'          => 'BROWN Skirt',
                'Description'   => 'Main Fabric: 100% POLYESTER, Length: Mid Length, Pattern: Leopard Print, Fit: Regular, Product Type: Skirt, Lining Detail: Without Lining, Color: Brown Printed',
                'Price'         => 14.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/bottoms/b2/p1.png",
                    "img/women/bottoms/b2/p2.png",
                    "img/women/bottoms/b2/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'Name'          => 'Classic GREY Skirt',
                'Description'   => 'Length: Mid Length, Pattern: Plain, Fit: Slim, Thickness: Thick, Product Type: Skirt, Fabric: Tricot, Lining Detail: Without Lining, Color: Light Grey',
                'Price'         => 9.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/bottoms/b3/p1.png",
                    "img/women/bottoms/b3/p2.png",
                    "img/women/bottoms/b3/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'Name'          => 'Elastic Waist Printed Jogger Sweatpants',
                'Description'   => 'Pattern: Printed, Fit: Loose, Thickness: Medium Thickness, Product Type: Jogger Sweatpants, Fabric: 2 Thread Inside Brushed, Leg Fit: Elasticated Hem, Color: Green',
                'Price'         => 9.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/bottoms/b4/p1.png",
                    "img/women/bottoms/b4/p2.png",
                    "img/women/bottoms/b4/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'Name'          => 'Elastic Waist Jogger Sweatpants',
                'Description'   => 'Pattern: Plain, Fit: Regular, Thickness: Medium Thickness, Product Type: Jogger Sweatpants, Fabric: Interlock, Leg Fit: Elasticated Hem, Collection: Big Size, Color: Anthracite',
                'Price'         => 16.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/bottoms/b5/p1.png",
                    "img/women/bottoms/b5/p2.png",
                    "img/women/bottoms/b5/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'Name'          => 'Straight Fit Shiny Jeans',
                'Description'   => 'Pattern: Plain, Fit: Straight, Thickness: Medium Thickness, Product Type: Jean, Fabric: Denim, Material: 100% Cotton, Color: Indigo',
                'Price'         => 14.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/bottoms/b6/p1.png",
                    "img/women/bottoms/b6/p2.png",
                    "img/women/bottoms/b6/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'Name'          => 'Wideleg Cargo Jean Pants',
                'Description'   => 'Fit: Regular, Product Type: Jean, Material: 100% Cotton, Color: Indigo',
                'Price'         => 19.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/bottoms/b7/p1.png",
                    "img/women/bottoms/b7/p2.png",
                    "img/women/bottoms/b7/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 5,
                'Name'          => 'Wideleg Jeans',
                'Description'   => 'Pattern: Plain, Fit: Wideleg, Thickness: Medium Thickness, Product Type: Jean, Fabric: Denim, Leg Fit: Wide Leg, Material: 100% Cotton, Color: Black',
                'Price'         => 19.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/bottoms/b8/p1.png",
                    "img/women/bottoms/b8/p2.png",
                    "img/women/bottoms/b8/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 6 - Women Shoes
            [
                'CategoryID'    => 6,
                'Name'          => 'Crew Neck Polka Dot T-Shirt',
                'Description'   => 'Main Fabric: 3% ELASTANE/SPANDEX 16% POLYESTER 81% VISCOSE/RAYON, Pattern: Polka Dot, Fit: Slim, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: T-Shirt, Collar: Crew Neck, Fabric: Combed, Collection: Big Size, Color: Black Printed',
                'Price'         => 9.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/tops/top1/p1.png",
                    "img/women/tops/top1/p2.png",
                    "img/women/tops/top1/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'Name'          => 'Crew Neck OverSized T-Shirt',
                'Description'   => 'Main Fabric: 100% COTTON, Pattern: Printed, Fit: OverSize, Thickness: Thin, Sleeve Length: Short Sleeve, Product Type: T-Shirt, Collar: Crew Neck, Fabric: Combed, Color: Navy',
                'Price'         => 6.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/tops/top2/p1.png",
                    "img/women/tops/top2/p2.png",
                    "img/women/tops/top2/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'Name'          => 'Crew Neck Printed T-shirt',
                'Description'   => 'Pattern: Printed, Fit: Loose, Thickness: Thin, Sleeve Length: Short Sleeve, Product Type: T-Shirt, Collar: Crew Neck, Fabric: Combed, Material: 100% Cotton, Color: White',
                'Price'         => 6.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/tops/top3/p1.png",
                    "img/women/tops/top3/p2.png",
                    "img/women/tops/top3/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'Name'          => 'Crew Neck Striped T-shirt',
                'Description'   => 'Pattern: Striped, Fit: Regular, Thickness: Thin, Sleeve Length: Long Sleeve, Product Type: T-Shirt, Collar: Crew Neck, Fabric: Combed, Occasion: Casual, Color: Anthracite Striped',
                'Price'         => 9.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/tops/top4/p1.png",
                    "img/women/tops/top4/p2.png",
                    "img/women/tops/top4/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'Name'          => 'Shirt Collar Striped Shirt',
                'Description'   => 'Main Fabric: 14% POLYAMIDE/NYLON 86% VISCOSE/RAYON, Fit: Regular, Product Type: Shirt, Color: Black Striped',
                'Price'         => 12.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/tops/top5/p1.png",
                    "img/women/tops/top5/p2.png",
                    "img/women/tops/top5/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'Name'          => 'Square Neck Straight Body',
                'Description'   => 'Main Fabric: 7% ELASTANE/SPANDEX 93% POLYAMIDE, Pattern: Plain, Fit: Extra Slim, Thickness: Thin, Sleeve Length: Long Sleeve, Product Type: Body, Collar: Square Collar, Silhouette: Bodycon, Collection: Big Size, Color: Grey',
                'Price'         => 9.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/tops/top6/p1.png",
                    "img/women/tops/top6/p2.png",
                    "img/women/tops/top6/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'Name'          => 'V Neck Printed T-shirt',
                'Description'   => 'Main Fabric: 4% ELASTANE/SPANDEX 96% VISCOSE/RAYON, Pattern: Printed, Fit: Regular, Thickness: Thin, Sleeve Length: Long Sleeve, Product Type: T-Shirt, Collar: V Neck, Fabric: Combed, Collection: Big Size, Color: Navy',
                'Price'         => 9.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/tops/top7/p1.png",
                    "img/women/tops/top7/p2.png",
                    "img/women/tops/top7/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 6,
                'Name'          => 'Polo Neck T-Shirt',
                'Description'   => 'Main Fabric: 1% ELASTANE/SPANDEX 17% POLYESTER 82% COTTON, Fit: Regular, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: T-Shirt, Collar: Shirt Collar, Material: Contains High Cotton, Color: Pink',
                'Price'         => 10.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 5,
                'Photo'         => json_encode([
                    "img/women/tops/top8/p1.png",
                    "img/women/tops/top8/p2.png",
                    "img/women/tops/top8/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 7 - Women Shoes
            [
                'CategoryID'    => 7,
                'Name'          => 'Straw Wedge Heeled Shoes',
                'Description'   => 'Pattern: Plain, Product Type: High Heels, Fabric: Mat, Toe Style: Round Toe, Heel Height: 5 cm, Shoe Closing Style: Buckle, Heel Style: Wedge Heel, Color: Khaki',
                'Price'         => 24.95,
                'Size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/women/shoes/s1/p1.png",
                    "img/women/shoes/s1/p2.png",
                    "img/women/shoes/s1/p3.png",
                    "img/women/shoes/s1/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'Name'          => 'Lace-Up Ankle-Size Sneaker',
                'Description'   => 'Pattern: Plain, Product Type: Sneakers, Toe Style: Round Toe, Shoe Closing Style: Shoestring, Color: Mix Printed (White & Camel)',
                'Price'         => 19.99,
                'Size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/women/shoes/s2/p1.png",
                    "img/women/shoes/s2/p2.png",
                    "img/women/shoes/s2/p3.png",
                    "img/women/shoes/s2/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'Name'          => 'Leather Look Classic Shoes',
                'Description'   => 'Pattern: Plain, Product Type: Classic Shoes, Toe Style: Oval Toe, Shoe Closing Style: Pull On, Color: Black',
                'Price'         => 6.99,
                'Size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/women/shoes/s3/p1.png",
                    "img/women/shoes/s3/p2.png",
                    "img/women/shoes/s3/p3.png",
                    "img/women/shoes/s3/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'Name'          => 'Mesh Detailed Sneakers',
                'Description'   => 'Pattern: Plain, Product Type: Sneakers, Fabric: Tricot, Toe Style: Round Toe, Shoe Closing Style: Shoestring, Color: Beige',
                'Price'         => 16.99,
                'Size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/women/shoes/s4/p1.png",
                    "img/women/shoes/s4/p2.png",
                    "img/women/shoes/s4/p3.png",
                    "img/women/shoes/s4/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'Name'          => 'Pointed Toe Leather Look Flats',
                'Description'   => 'Pattern: Patterned, Product Type: Flats, Fabric: Imitation Leather, Toe Style: Pointy toe, Color: Beige',
                'Price'         => 9.99,
                'Size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/women/shoes/s5/p1.png",
                    "img/women/shoes/s5/p2.png",
                    "img/women/shoes/s5/p3.png",
                    "img/women/shoes/s5/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'Name'          => 'Lace-Up and Zipper Boots',
                'Description'   => 'Pattern: Plain, Product Type: Boots, Fabric: Imitation Leather, Toe Style: Round Toe, Shoe Closing Style: Shoestring and Zipper, Color: Black',
                'Price'         => 29.99,
                'Size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/women/shoes/s6/p1.png",
                    "img/women/shoes/s6/p2.png",
                    "img/women/shoes/s6/p3.png",
                    "img/women/shoes/s6/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'Name'          => 'Lace-Up Sneakers',
                'Description'   => 'Pattern: Plain, Product Type: Sneakers, Fabric: Canvas, Toe Style: Round Toe, Heel Height: 3 cm, Shoe Closing Style: Shoestring, Color: Black',
                'Price'         => 19.95,
                'Size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/women/shoes/s7/p1.png",
                    "img/women/shoes/s7/p2.png",
                    "img/women/shoes/s7/p3.png",
                    "img/women/shoes/s7/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 7,
                'Name'          => 'Lace-Up Sneakers',
                'Description'   => 'Inner Sole: 100% TEXTILE MATERIAL, Lining: 100% TEXTILE MATERIAL, Outer Sole: 100% OTHER MATERIAL (PVC), Upper: 50% OTHER MATERIAL (POLYURETHANE) 50% TEXTILE MATERIAL, Pattern: Patterned, Product Type: Sneakers, Toe Style: Round Toe, Shoe Closing Style: Shoestring, Color: Buxe White',
                'Price'         => 29.99,
                'Size'          => json_encode([38, 39, 40, 41, 42, 43, 44]),
                'Quantity'      => 10,
                'Points'        => 6,
                'Photo'         => json_encode([
                    "img/women/shoes/s8/p1.png",
                    "img/women/shoes/s8/p2.png",
                    "img/women/shoes/s8/p3.png",
                    "img/women/shoes/s8/p4.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // CategoryID 8 - Women Dresses
            [
                'CategoryID'    => 8,
                'Name'          => 'BROWN Shirt Dress',
                'Description'   => 'Length: Long, Pattern: Plain, Fit: Loose, Sleeve Length: Long Sleeve, Product Type: Shirt Dress, Collar: Shirt Collar, Fabric: Viscone, Lining Detail: Without Lining, Product Additional Accessory: Sash, Color: Brown',
                'Price'         => 19.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 8,
                'Photo'         => json_encode([
                    "img/women/dresses/d1/p1.png",
                    "img/women/dresses/d1/p2.png",
                    "img/women/dresses/d1/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'Name'          => 'Crew Neck Plaid Shirt Dress',
                'Description'   => 'Length: Long, Pattern: Plaid, Fit: Regular, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: Shirt Dress, Collar: Crew Neck, Fabric: Twill, Lining Detail: Without Lining, Color: Red & Black',
                'Price'         => 17.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 8,
                'Photo'         => json_encode([
                    "img/women/dresses/d2/p1.png",
                    "img/women/dresses/d2/p2.png",
                    "img/women/dresses/d2/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'Name'          => 'Crew Neck Dress',
                'Description'   => 'Length: Long, Pattern: Plain, Fit: Slim, Sleeve Length: Long Sleeve, Product Type: Dress, Collar: Crew Neck, Lining Detail: Without Lining, Color: Dark Green',
                'Price'         => 11.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 8,
                'Photo'         => json_encode([
                    "img/women/dresses/d3/p1.png",
                    "img/women/dresses/d3/p2.png",
                    "img/women/dresses/d3/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'Name'          => 'ECRU Dress',
                'Description'   => 'Length: Mid Length, Pattern: Color Block, Fit: Loose, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: Dress, Collar: Turtleneck / Mock Turtleneck, Fabric: Tricot, Lining Detail: Without Lining, Color: Ecru & Black',
                'Price'         => 14.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 8,
                'Photo'         => json_encode([
                    "img/women/dresses/d4/p1.png",
                    "img/women/dresses/d4/p2.png",
                    "img/women/dresses/d4/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'Name'          => 'Modest Crew Neck Dress',
                'Description'   => 'Length: Long, Pattern: Plain, Fit: Standard, Thickness: Thin, Sleeve Length: Long Sleeve, Product Type: Dress, Collar: Crew Neck, Lining Detail: Without Lining, Collection: Hijab Clothing, Color: Black',
                'Price'         => 15.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 8,
                'Photo'         => json_encode([
                    "img/women/dresses/d5/p1.png",
                    "img/women/dresses/d5/p2.png",
                    "img/women/dresses/d5/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'Name'          => 'Patterned Waist Belted Shirt Dress',
                'Description'   => 'Length: Long, Pattern: Printed, Fit: Regular, Sleeve Length: Long Sleeve, Product Type: Shirt Dress, Collar: Shirt Collar, Fabric: Viscone, Color: Green',
                'Price'         => 29.95,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 8,
                'Photo'         => json_encode([
                    "img/women/dresses/d6/p1.png",
                    "img/women/dresses/d6/p2.png",
                    "img/women/dresses/d6/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'Name'          => 'Patterned Shirt Dress',
                'Description'   => 'Length: Long, Pattern: Patterned, Fit: Loose, Thickness: Thin, Sleeve Length: Long Sleeve, Product Type: Shirt Dress, Collar: Shirt Collar, Lining Detail: Without Lining, Product Additional Accessory: Sash, Color: Navy',
                'Price'         => 19.95,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 8,
                'Photo'         => json_encode([
                    "img/women/dresses/d7/p1.png",
                    "img/women/dresses/d7/p2.png",
                    "img/women/dresses/d7/p3.png"
                ]),
                'isAvailable'   => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'CategoryID'    => 8,
                'Name'          => 'Patterned Shirt Dress',
                'Description'   => 'Length: Long, Pattern: Patterned, Fit: Regular, Thickness: Medium Thickness, Sleeve Length: Long Sleeve, Product Type: Shirt Dress, Collar: Shirt Collar, Lining Detail: Without Lining, Product Additional Accessory: Sash, Collection: Big Size, Color: Mix Printed(Navy, Beige & Camel)',
                'Price'         => 22.99,
                'Size'          => json_encode(["S", "M", "L", "XL"]),
                'Quantity'      => 10,
                'Points'        => 8,
                'Photo'         => json_encode([
                    "img/women/dresses/d8/p1.png",
                    "img/women/dresses/d8/p2.png",
                    "img/women/dresses/d8/p3.png"
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
