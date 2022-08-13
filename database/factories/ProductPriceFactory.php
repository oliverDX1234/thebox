<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $discount = rand()%2 === 0;
        return [
            "product_id" => $this->faker->numberBetween($min = 1, $max = 50),
            "price" => $this->faker->numberBetween($min = 100, $max = 500),
            "supplier_price" => $this->faker->numberBetween($min = 50, $max = 100),
            "discounted_price" => $discount ? null : $this->faker->numberBetween(150, 300),
            "discount_valid_until" => $discount ? null : $this->faker->dateTimeBetween("+ 0 days", "+ 30 days")
        ];
    }
}
