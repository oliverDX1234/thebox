<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\FillRepositoryInterface;

class FillRepository implements FillRepositoryInterface
{

    public function getCities()
    {
        return City::all();
    }
}
