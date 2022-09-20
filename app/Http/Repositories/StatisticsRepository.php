<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\StatisticsRepositoryInterface;
use App\Models\Discount;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StatisticsRepository implements StatisticsRepositoryInterface
{
    public function getUserGenderStatistics(): Collection
    {
        return DB::table("users")->selectRaw('gender AS statKey, count(id) AS value')->where("active", 1)->groupBy("gender")->get();
    }

    public function getUserAgeStatistics(): Collection
    {
        $ranges = [ // the start of each age-range.
            '0-21' => 21,
            '21-35' => 35,
            '36-50' => 50,
            '50+' => 100
        ];

        return User::get()
            ->map(function ($user) use ($ranges) {
                $age = Carbon::parse($user->dob)->age;
                foreach($ranges as $key => $breakpoint)
                {
                    if ($breakpoint >= $age)
                    {
                        $user->range = $key;
                        break;
                    }
                }

                return $user;
            })
            ->mapToGroups(function ($user, $key) {
                return [$user->range => $user];
            })
            ->map(function ($group) {
                return count($group);
            })
            ->sortKeys();
    }

    public function getUserCityStatistics(): Collection
    {
        return User::join("cities", "city_id", "=", "cities.id")->selectRaw("city_name_en as statKey, COUNT(users.id) as value")->where("active", "=", 1)->groupBy("city_name_en")->get();
    }

    public function getProductSupplierStatistics(): Collection
    {
        return Product::join("suppliers", "products.supplier_id", "=", "suppliers.id")->selectRaw("suppliers.name as statKey, COUNT(products.id) as value")->where("products.active", "=", 1)->groupBy("suppliers.name")->get();
    }

    public function getProductCategoryStatistics(): Collection
    {
        return Product::join("category_product", "products.id", "=", "category_product.product_id")->join("categories", "category_product.category_id", "=", "categories.id")->selectRaw("categories.name as statKey, COUNT(products.id) as value")->groupBy("categories.name")->whereNull("categories.parent")->where("products.active", "=", 1)->limit(7)->get();
    }

    public function getProductSeenTimesStatistics(): Collection
    {
        return Product::select(["name AS product_name", "seen_times AS value"])->where("products.active", "=", 1)->orderBy("seen_times", "DESC")->limit(7)->get();
    }
}
