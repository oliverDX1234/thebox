<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\StatisticsRepositoryInterface;
use Exception;

class StatisticsService
{
    protected $statisticsRepository;

    public function __construct(StatisticsRepositoryInterface $statisticsRepository)
    {
        $this->statisticsRepository = $statisticsRepository;
    }

    /**
     * @throws ApiException
     */
    public function getStatisticsForUsers()
    {

        try{
            $genderStatistics =  $this->statisticsRepository->getUserGenderStatistics();
            $ageStatistics = $this->statisticsRepository->getUserAgeStatistics();

            $statistics = [];

            foreach($genderStatistics as $key => $statistic){
                $statistics["gender"][$statistic->statKey] =  $statistic->value;
            }

            foreach($ageStatistics as $key => $statistic){
                $statistics["age"][$key] =  $statistic;
            }


            return $statistics;

        }catch(Exception $e){
            dd($e);
            throw new ApiException("statistics.statistics_fetch_error", $e->getCode(), $e);
        }

    }
}
