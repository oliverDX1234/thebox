<?php

namespace App\Http\Controllers;

use App\Http\Services\StatisticsService;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    protected $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    /**
     * @throws \App\Exceptions\ApiException
     */
    public function getStatisticsForUsers()
    {
        $statistics = $this->statisticsService->getStatisticsForUsers();

        return response()->api(['statistics' => $statistics] , "statistics.statistics_retrieved_successfully", 200);
    }

    /**
     * @throws \App\Exceptions\ApiException
     */
    public function getStatisticsForProducts()
    {
        $statistics = $this->statisticsService->getStatisticsForProducts();


        return response()->api(['statistics' => $statistics] , "statistics.statistics_retrieved_successfully", 200);
    }

    public function getStatisticsForPackages()
    {
        $statistics = $this->statisticsService->getStatisticsForPackages();

        return response()->api(['statistics' => $statistics] , "statistics.statistics_retrieved_successfully", 200);
    }
}
