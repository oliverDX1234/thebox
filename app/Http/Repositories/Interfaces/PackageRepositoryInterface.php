<?php

namespace App\Http\Repositories\Interfaces;

interface PackageRepositoryInterface
{
    public function findById($id);

    public function getPackages($request);

    public function deletePackage($id);

    public function removePackageDiscount($id);
}
