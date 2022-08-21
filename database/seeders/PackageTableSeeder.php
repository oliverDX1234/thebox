<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::factory(7, [])->create();

        $arr = range(1,50);

        foreach (range(1, 7) as $number) {
            array(
                DB::table('package_product')->insert(array('product_id' => $arr[0], 'package_id' => $number)),
                DB::table('package_product')->insert(array('product_id' => $arr[1], 'package_id' => $number)),
                DB::table('package_product')->insert(array('product_id' => $arr[2], 'package_id' => $number))
            );

            array_shift($arr);
            array_shift($arr);
            array_shift($arr);
        }

        $arr = range(1,5);

        foreach (range(1, 7) as $number) {
            DB::table('attribute_package')->insert(array('attribute_id' => $arr[$number % 5], 'package_id' => $number));

            DB::table('category_package')->insert(array('package_id' => $number, 'category_id' => $arr[$number % 5]));
        }
    }
}
