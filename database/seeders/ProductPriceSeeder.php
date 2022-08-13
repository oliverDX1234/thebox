<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductPrice;
use Database\Factories\ProductPriceFactory;
use Illuminate\Database\Seeder;

class ProductPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();

        $discount = rand()%2 === 0;

        foreach ($products as $product) {

            ProductPrice::factory([
                "product_id" => $product->id,
            ])->create();

        }
    }
}
