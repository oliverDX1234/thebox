<?php

namespace App\Http\Controllers;

use App\Http\Services\FillService;

class FillController extends Controller
{
    protected $fillservice;

    public function __construct(FillService $fillservice)
    {
        $this->fillservice = $fillservice;
    }

    public function getCities()
    {
        $cities = $this->fillservice->getCities();

        return response()->api(['cities' => $cities], "success", 200);

    }
}
