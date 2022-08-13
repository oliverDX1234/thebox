<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\DiscountRepositoryInterface;
use App\Models\Discount;

class DiscountRepository implements DiscountRepositoryInterface
{

    public function findById($id): Discount
    {
        return Discount::findOrFail($id);
    }


    public function getDiscounts($request)
    {
        $discounts =  Discount::query();

        if($request->has("statuses")){

            $discounts->where("active", "=", $request->statuses === "Active" ? 1 : 0);
        }

        return $discounts->get();
    }

    public function deleteDiscount($id)
    {

        return Discount::findOrFail($id)->delete();
    }


}
