<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Models\Supplier;

class SupplierRepository implements SupplierRepositoryInterface
{

    public function findById($id): Supplier
    {
        return Supplier::findOrFail($id);
    }


    public function getSuppliers()
    {
        return Supplier::all();
    }

    public function deleteSupplier($id)
    {

        return Supplier::findOrFail($id)->delete();
    }


}
