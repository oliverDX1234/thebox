<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('attributes')->insert(array(
            array('attribute' => 'blue', 'name' => 'Plava', 'filter_id' => 1),
            array('attribute' => 'enterprise', 'name' => 'Na Golemo', 'filter_id' => 2),
            array('attribute' => 'women', 'name' => 'Zheni', 'filter_id' => 3),
            array('attribute' => 'xxl', 'name' => 'XXL', 'filter_id' => 4),
            array('attribute' => 'gucci', 'name' => 'Gucci', 'filter_id' => 5),
        ));
    }
}
