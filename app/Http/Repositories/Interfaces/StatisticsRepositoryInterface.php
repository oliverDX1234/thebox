<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Discount;

interface StatisticsRepositoryInterface
{
    public function getUserGenderStatistics();

    public function getUserAgeStatistics();

    public function getUserCityStatistics();

    public function getProductSupplierStatistics();

    public function getProductCategoryStatistics();

    public function getProductSeenTimesStatistics();

    public function getPackageCategoryStatistics();

    public function getPackageSeenTimesStatistics();
}
