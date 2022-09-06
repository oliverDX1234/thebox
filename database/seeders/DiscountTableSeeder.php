<?php

namespace Database\Seeders;

use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DiscountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discount::factory(8, [])->create();


        $premadeDiscounts = [
            5,
            10,
            15,
            20,
            25,
            30,
            35,
            40,
            45,
            50,
            55,
            60,
            65,
            70,
            75,
            80,
            85,
            90
        ];

//TODO move to separate seeder, to be used on production
        foreach ($premadeDiscounts as $discount) {
            Discount::factory()->create([
                'value' => $discount,
                'name' => "Default Discount $discount%",
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addYears(100),
                'type' => 'percent',
                'active' => true,
                'is_default' => true
            ]);
        }

    }
}
