<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\CourierRepositoryInterface;
use App\Models\Courier;

class CourierRepository implements CourierRepositoryInterface
{

    public function findById($id): Courier
    {
        return Courier::where("id", $id)->firstOrFail();
    }

    public function getCouriers($request)
    {
        $couriers = Courier::query();

        if($request->has("statuses")){

            $couriers->where("active", "=", $request->statuses === "Active" ? 1 : 0);
        }

        return $couriers->get();
    }

    public function deleteCourier($id)
    {
        Courier::where("id", $id)->delete();
    }


}
