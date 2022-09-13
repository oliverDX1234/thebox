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

        return response()->api(['statistics' => $statistics] , "statistics.user_statistics_retrieved", 200);
    }
}
