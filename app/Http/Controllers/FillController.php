<?php

namespace App\Http\Controllers;

use App\Http\Services\FillService;

class FillController extends Controller
{
    protected $fileService;

    public function __construct(FillService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function getCities()
    {

    }
}
