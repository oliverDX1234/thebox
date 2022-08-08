<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    public function findById($id): Product
    {
        return Product::findOrFail($id);
    }


    public function getProducts()
    {
        return Product::with("categories")->get();
    }

    public function deleteProduct($id)
    {
        return Product::findOrFail($id)->delete();
    }


}
