<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
               
            ['id'=>1,'section_id'=>1,'category_name'=>'Sofas','category_image'=>'','category_discount'=>0,'decsription'=>'','url'=>''],
            ['id'=>2,'section_id'=>1,'category_name'=>'Stools & Pouffes','category_image'=>'','category_discount'=>0,'decsription'=>'','url'=>'']
        ];

        Category::insert($categoryRecords);
    }
}
