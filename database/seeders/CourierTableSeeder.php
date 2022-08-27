<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CourierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table("couriers")->insert(array(
            array("name" => "Mex", "email" => "mex@gmail.com", "price" => 100, "active" => true),
            array("name" => "Kolporter", "email" => "kolporter@gmail.com", "price" => 120, "active" => true),
            array("name" => "Fedex", "email" => "fedex@gmail.com", "price" => 150, "active" => true)
        ));
    }
}
