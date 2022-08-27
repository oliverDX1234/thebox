<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::factory(50, [])->create();

        $arr = range(1,5);

        foreach (range(1, 50) as $number) {
            DB::table('attribute_product')->insert(array('attribute_id' => $arr[$number % 5], 'product_id' => $number));

            DB::table('category_product')->insert(array('product_id' => $number, 'category_id' => $arr[$number % 5]));
        }
    }
}
