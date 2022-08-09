<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::factory(50, [])->create();

        DB::table('attribute_product')->insert(array(

            array('attribute_id' => 1, 'product_id' => 1),
            array('attribute_id' => 2, 'product_id' => 1),
            array('attribute_id' => 1, 'product_id' => 2),
            array('attribute_id' => 1, 'product_id' => 5),
            array('attribute_id' => 5, 'product_id' => 1),
            array('attribute_id' => 1, 'product_id' => 4),
            array('attribute_id' => 4, 'product_id' => 5),
        ));
            DB::table('category_product')->insert(array(
            array('product_id' => 1, 'category_id' => 1),
            array('product_id' => 2, 'category_id' => 2),
            array('product_id' => 3, 'category_id' => 2),
            array('product_id' => 4, 'category_id' => 2),
            array('product_id' => 5, 'category_id' => 3),
            array('product_id' => 6, 'category_id' => 1),
            array('product_id' => 7, 'category_id' => 5),
            array('product_id' => 1, 'category_id' => 5),
            array('product_id' => 2, 'category_id' => 5),
            array('product_id' => 5, 'category_id' => 5),
            array('product_id' => 1, 'category_id' => 2),
            array('product_id' => 2, 'category_id' => 4),
            array('product_id' => 5, 'category_id' => 1),
            array('product_id' => 4, 'category_id' => 5),
            array('product_id' => 4, 'category_id' => 3),
            array('product_id' => 1, 'category_id' => 4),
            array('product_id' => 2, 'category_id' => 3),
            array('product_id' => 5, 'category_id' => 2),
            array('product_id' => 3, 'category_id' => 5),
        ));
    }
}
