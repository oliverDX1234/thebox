<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filters')->insert(array(
            array('filter' => 'Color', 'name' => 'Boja', 'active' => 1),
            array('filter' => 'Production', 'name' => 'Produkcija', 'active' => 1),
            array('filter' => 'Gender', 'name' => 'Pol', 'active' => 1),
            array('filter' => 'Size', 'name' => 'Golemina', 'active' => 1),
            array('filter' => 'Brand', 'name' => 'Brend', 'active' => 1)
        ));
        DB::table('category_filter')->insert(array(
            array('filter_id' => 1, 'category_id' => 1),
            array('filter_id' => 1, 'category_id' => 2),
            array('filter_id' => 2, 'category_id' => 2),
            array('filter_id' => 5, 'category_id' => 2),
            array('filter_id' => 5, 'category_id' => 3),
            array('filter_id' => 5, 'category_id' => 1),
            array('filter_id' => 1, 'category_id' => 5),
            array('filter_id' => 2, 'category_id' => 5),
        ));
    }
}
