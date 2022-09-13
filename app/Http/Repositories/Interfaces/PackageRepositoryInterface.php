<?php

namespace App\Http\Repositories\Interfaces;

interface PackageRepositoryInterface
{
    public function findById($id);

    public function getPackages($categories, $statuses, $products, $discounts, $preMadeStatuses);

    public function deletePackage($id);

    public function removePackageDiscount($id);

    public function getPackagePrice($id);
}
