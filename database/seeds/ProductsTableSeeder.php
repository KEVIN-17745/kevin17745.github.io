<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsRecords =[

          ['id'=>1,   
          'category_id'=>1,
          'section_id'=>1,
          'product_name'=>'3 Seater Sofs',
          'product_code'=>'sofa001',
          'product_color'=>'Drak gray',
          'main_image'=>'',
          'description'=>'',
          'product_price'=> 45000,
          'product_discount'=>2,
          'product_diamensions'=>'210W 91D 83 H',
          'product_material'=>'Solid wood',
          'is_featured'=>'No',
          'status'=>1,

        ],
        ['id'=>2,   
          'category_id'=>1,
          'section_id'=>1,
          'product_name'=>'1 Seater Sofs',
          'product_code'=>'sofa002',
          'product_color'=>'Pink',
          'main_image'=>'',
          'description'=>'',
          'product_price'=> 25000,
          'product_discount'=>2,
          'product_diamensions'=>'88W 91D 83H',
          'product_material'=>'Solid wood',
          
          'is_featured'=>'No',
          'status'=>1,
        ]
        ];
        Product::insert($productsRecords);
    }
}
