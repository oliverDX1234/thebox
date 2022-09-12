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

    public function getDiscounts($statuses, $discountTypes, bool|null $showDefaults, bool|null $showSpecifics)
    {
        $discounts = Discount::with("products")
            ->where("end_date", ">", Carbon::now()->format('Y-m-d H:i'))
            ->orWhere("end_date", "=", null);

        if ($statuses) {
            $discounts->where("active", "=", $statuses === "Active" ? 1 : 0);
        }

        if ($discountTypes) {
            $discounts->where("type", "=", $discountTypes === "Fixed" ? "fixed" : "percent");
        }

        if(!$showDefaults) {
            $discounts->where("is_default", false);
        }

        if(!$showSpecifics) {
            $discounts->where("specific", false);
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
