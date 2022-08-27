<?php

namespace Database\Factories;

use App\Models\Courier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $total_price = $this->faker->numberBetween($min = 2000, $max = 5000);

        return [
            "user_id" => User::all()->random()->id,
            "courier_id" => Courier::all()->random()->id,
            "order_number" => "Order-" . rand(1000000, 9999999),
            "payment_type" => "cash",
            "paid" => $this->faker->randomElement([true, false]),
            "user_shipping_details" => json_encode([
                "email" => $this->faker->email(),
                "phone" => $this->faker->phoneNumber(),
                "first_name" => $this->faker->firstName(),
                "last_name" => $this->faker->lastName(),
                "address" => $this->faker->address(),
                "city" => $this->faker->city()
            ]),
            "checksum" => null,
            "total_price" => $total_price,
            "total_price_no_vat" => $this->faker->numberBetween($min = 2000, $max = $total_price),
            "delivery_price" => 0,
            'order_sent_at' => Carbon::now()->toDateTimeLocalString(),
            'order_delivered_at' => Carbon::now()->addDays(rand(1,5))->toDateTimeLocalString(),
            "created_at" => Carbon::now()->toDateTimeLocalString(),
            'updated_at' => Carbon::now()->toDateTimeLocalString()
        ];
    }
}
