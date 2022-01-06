<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\FillRepositoryInterface;
use App\Models\City;

class FillRepository implements FillRepositoryInterface
{

    public function getCities()
    {
        return City::all();
    }
}
