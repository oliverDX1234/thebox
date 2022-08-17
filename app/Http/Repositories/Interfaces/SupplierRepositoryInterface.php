<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Supplier;

interface SupplierRepositoryInterface
{
    public function findById(int $id): Supplier;

    public function getSuppliers($request);

    public function deleteSupplier(int $id);

}
