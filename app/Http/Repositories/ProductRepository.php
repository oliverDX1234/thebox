<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Carbon\Carbon;

class ProductRepository implements ProductRepositoryInterface
{

    public function findById($id): Product
    {
        return Product::where("id", $id)->with("supplier")->first();
    }

    public function getProducts($request)
    {

        $products = Product::with("categories:id,name", "supplier:id,name");

        if ($request->has("categories")) {
            $products->whereHas("categories", function ($q) use ($request) {
                $q->where('id', '=', $request->categories);
            });
        }

        if ($request->has("suppliers")) {
            $products->whereHas("supplier", function ($q) use ($request) {
                $q->where('id', '=', $request->suppliers);
            });
        }

        if ($request->has("statuses")) {

            $products->where("active", "=", $request->statuses === "Active" ? 1 : 0);
        }

        if ($request->has("discounts")) {

            if ($request->discounts === "Discount") {
                $products->whereHas("discount", function ($q) {
                    $q->where("active", "=", true)
                        ->whereRaw("start_date < STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s')", Carbon::now()->format('Y-m-d H:i'))
                        ->whereRaw("end_date > STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s')", Carbon::now()->format('Y-m-d H:i'));
                });
            } else {
                $products->whereNull("discount_id")->orWhereHas("discount", function ($q) {
                    $q->whereRaw("start_date > STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s')", Carbon::now()->format('Y-m-d H:i'))
                        ->orWhere("active", "=", false);
                });
            }
        }

        $products->select("products.*");

        return $products->get();
    }

    public function deleteProduct($id)
    {
        Product::findOrFail($id)->delete();
    }

    public function removeProductDiscount($id)
    {
        Product::where("id", $id)->update([
            "discount_id" => null
        ]);
    }


}
