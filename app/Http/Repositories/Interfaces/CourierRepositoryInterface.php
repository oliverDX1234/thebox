<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Courier;

interface CourierRepositoryInterface
{
    public function findById(int $id): Courier;

    public function getCouriers($request);

    public function deleteCourier(int $id);

}
