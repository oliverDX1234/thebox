<?php

namespace App\Http\Repositories\Interfaces;

interface PackageRepositoryInterface
{
    public function findById($id);

    public function getPackages($categories, $statuses, $products, $discounts);

    public function deletePackage($id);

    public function removePackageDiscount($id);
}
