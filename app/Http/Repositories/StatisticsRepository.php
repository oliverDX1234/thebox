<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\StatisticsRepositoryInterface;
use App\Models\Discount;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsRepository implements StatisticsRepositoryInterface
{
    public function getUserGenderStatistics()
    {
        return DB::table("users")->selectRaw('gender AS statKey, count(id) AS value')->where("active", 1)->groupBy("gender")->get();
    }

    public function getUserAgeStatistics()
    {
        $ranges = [ // the start of each age-range.
            '0-21' => 21,
            '21-35' => 35,
            '36-50' => 50,
            '50+' => 100
        ];

        $outputArray = User::get()
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

        return $outputArray;
    }
}
