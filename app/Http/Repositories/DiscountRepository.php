<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\DiscountRepositoryInterface;
use App\Models\Discount;
use App\Models\Product;
use Carbon\Carbon;

class DiscountRepository implements DiscountRepositoryInterface
{

    public function findById($id): Discount
    {
        return Discount::findOrFail($id);
    }

    public function getDiscounts($request)
    {
        $discounts = Discount::with("products")
            ->where("end_date", ">", Carbon::now()->format('Y-m-d H:i'))
            ->orWhere("end_date", "=", null);

        if ($request->has("statuses")) {
            $discounts->where("active", "=", $request->statuses === "Active" ? 1 : 0);
        }

        if ($request->has("discountTypes")) {
            $discounts->where("type", "=", $request->discountTypes === "Fixed" ? "fixed" : "percent");
        }

        if(!$request->has('showDefaults') || !$request->showDefaults) {
            $discounts->where("is_default", false);
        }

        return $discounts->get();
    }

    public function deleteDiscount($id)
    {
        return Discount::findOrFail($id)->delete();
    }

    public function getProductsForDiscount(int $id)
    {
        return Product::where("discount_id", "=", $id)->get();
    }

    public function updateStatus(int $id)
    {
        $discount = Discount::where("id", $id)->firstOrFail();

        $discount->update([
            "active" => !$discount->active
        ]);;
    }
}
