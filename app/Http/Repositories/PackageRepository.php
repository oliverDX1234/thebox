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

    public function getPackages($request)
    {

        $packages = Package::with("categories:id,name", "products:id,name");

        if ($request->has("categories")) {
            $packages->whereHas("categories", function ($q) use ($request) {
                $q->where('id', '=', $request->categories);
            });
        }

        if ($request->has("statuses")) {

            $packages->where("active", "=", $request->statuses === "Active" ? 1 : 0);
        }

        if ($request->has("discounts")) {

            if ($request->discounts === "Discount") {
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


}
