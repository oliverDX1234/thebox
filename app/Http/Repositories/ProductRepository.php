<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    public function findById($id): Product
    {
        return Product::where("id", "=", $id)->with("supplier", "price")->first();
    }


    public function getProducts($request)
    {

        $products = Product::with("categories:id,name", "supplier:id,name", "price");

        if($request->has("categories")){
            $products->whereHas("categories", function($q) use($request){
                $q->where('id','=', $request->categories);
            });
        }

        if($request->has("suppliers")){
            $products->whereHas("supplier", function($q) use($request){
                $q->where('id','=', $request->suppliers);
            });
        }

        if($request->has("statuses")){

            $products->where("active", "=", $request->statuses === "Active" ? 1 : 0);
        }

        if($request->has("discounts")){
            $products->whereHas("price", function($q) use ($request){

                $q->whereNull("discounted_price", "and", $request->discounts === "Discount");
            });
        }

        $products->select("products.id", "products.name", "products.active", "products.unit_code", "products.supplier_id");

        return $products->get();
    }

    public function deleteProduct($id)
    {
        return Product::findOrFail($id)->delete();
    }


}
