<?php

use Illuminate\Database\Seeder;
use App\Section;
class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionRecords = [
            ['id'=>1,'name'=>'Living'],
            ['id'=>2,'name'=>'Dining'],
            ['id'=>3,'name'=>'Bedroom'],
        ];

        Section::insert($sectionRecords);
    }
}
