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
    public function getStatisticsForUsers(): array
    {

        try{
            $genderStatistics =  $this->statisticsRepository->getUserGenderStatistics();
            $ageStatistics = $this->statisticsRepository->getUserAgeStatistics();
            $cityStatistics = $this->statisticsRepository->getUserCityStatistics();

            $statistics = [];

            foreach($genderStatistics as $key => $statistic){
                $statistics["gender"][$statistic->statKey] =  $statistic->value;
            }

            foreach($ageStatistics as $key => $statistic){
                $statistics["age"][$key] =  $statistic;
            }

            foreach ($cityStatistics as $key => $statistic){
                $statistics["city"][$statistic->statKey] = $statistic->value;
            }


            return $statistics;

        }catch(Exception $e){

            throw new ApiException("statistics.statistics_fetch_error", $e->getCode(), $e);
        }

    }

    /**
     * @throws ApiException
     */
    public function getStatisticsForProducts(): array
    {
        try {
            $supplierStatistics = $this->statisticsRepository->getProductSupplierStatistics();
            $categoryStatistics = $this->statisticsRepository->getProductCategoryStatistics();
            $seenTimesStatistics = $this->statisticsRepository->getProductSeenTimesStatistics();

            $statistics = [];

            foreach( $supplierStatistics as $key => $statistic){
                $statistics["supplier"][$statistic->statKey] = $statistic->value;
            }

            foreach( $categoryStatistics as $key => $statistic){
                $statistics["category"][$statistic->statKey] = $statistic->value;
            }

            foreach($seenTimesStatistics as $statistic){
                $statistics["seen_times"][$statistic->product_name] = $statistic->value;
            }

            return $statistics;

        }catch(Exception $e){
            throw new ApiException("statistics.statistics_fetch_error", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function getStatisticsForPackages(): array
    {

        try {
            $categoryStatistics = $this->statisticsRepository->getPackageCategoryStatistics();
            $seenTimesStatistics = $this->statisticsRepository->getPackageSeenTimesStatistics();

            $statistics = [];

            foreach( $categoryStatistics as $key => $statistic){
                $statistics["category"][$statistic->statKey] = $statistic->value;
            }

            foreach($seenTimesStatistics as $statistic){
                $statistics["seen_times"][$statistic->product_name] = $statistic->value;
            }

            return $statistics;

        }catch(Exception $e){
            throw new ApiException("statistics.statistics_fetch_error", $e->getCode(), $e);
        }
    }
}
