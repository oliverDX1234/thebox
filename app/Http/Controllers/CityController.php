<?php

namespace App\Http\Controllers;

use App\Http\Services\CityService;

class CityController extends Controller
{
    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    public function getCities()
    {
        $cities = $this->cityService->getCities();

        return response()->api(['cities' => $cities], "success", 200);

    }
}
