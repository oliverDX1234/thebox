<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\CityRepositoryInterface;
use App\Models\City;

class CityRepository implements CityRepositoryInterface
{

    public function getCities()
    {
        return City::all();
    }
}
