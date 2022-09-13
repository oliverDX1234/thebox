<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\PackageRepositoryInterface;
use App\Models\Package;
use Carbon\Carbon;

class PackageRepository implements PackageRepositoryInterface
{

    public function findById($id): Package
    {
        return Package::where("id", $id)->with('products:id,name,unit_code,price,discount_id')->first();
    }

    public function getPackages($categories, $statuses, $products, $discounts, $preMadeStatuses)
    {

        $packages = Package::with("categories:id,name", "products:id,name");

        if ($categories) {
            $packages->whereHas("categories", function ($q) use ($categories) {
                $q->where('id', '=', $categories);
            });
        }

        if ($statuses) {
            $packages->where("active", "=", $statuses === "Active" ? 1 : 0);

        }

        if ($products) {
            $packages->whereHas("products", function ($q) use ($products) {
                $q->where("id", "=", $products);
            });
        }

        if ($discounts) {
            if ($discounts === "Discount") {
                $packages->whereHas("discount", function ($q) {
                    $q->where("active", "=", true)
                        ->whereRaw("start_date < STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s')", Carbon::now()->format('Y-m-d H:i'))
                        ->whereRaw("end_date > STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s')", Carbon::now()->format('Y-m-d H:i'));
                });
            } else {
                $packages->whereNull("discount_id")->orWhereHas("discount", function ($q) {
                    $q->whereRaw("start_date > STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s')", Carbon::now()->format('Y-m-d H:i'))
                        ->orWhere("active", "=", false);
                });
            }
        }

        if ($preMadeStatuses) {
            $packages->where("pre_made", "=", $preMadeStatuses === "Premade" ? 1 : 0);
        }

        $packages->select("packages.*");

        return $packages->get();
    }

    public function deletePackage($id)
    {
        Package::findOrFail($id)->delete();
    }

    public function removePackageDiscount($id)
    {
        Package::where("id", $id)->update([
            "discount_id" => null
        ]);
    }

    public function getPackagePrice($id): array
    {
        $package = Package::where("id", "=", $id)->first();

        return [
            "price" => $package->price_discount ?? $package->price,
            "price_no_vat" => $package->price_no_vat
        ];
    }
}
