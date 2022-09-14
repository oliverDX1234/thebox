<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Discount;

interface StatisticsRepositoryInterface
{
    public function getUserGenderStatistics();

    public function getUserAgeStatistics();

    public function getUserCityStatistics();
}
