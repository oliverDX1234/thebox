<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Models\Supplier;

class SupplierRepository implements SupplierRepositoryInterface
{

    public function findById($id): Supplier
    {
        return Supplier::where("id", $id)->with("city")->firstOrFail();
    }

    public function getSuppliers($request)
    {
        $suppliers =  Supplier::with("city");

        if($request->has("statuses")){

            $suppliers->where("active", "=", $request->statuses === "Active" ? 1 : 0);
        }

        return $suppliers->get();
    }

    public function deleteSupplier($id)
    {
        Supplier::where("id", $id)->delete();
    }


}
