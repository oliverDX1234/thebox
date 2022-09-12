<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "value" => $this->faker->numberBetween(10, 50),
            "name" => $this->faker->colorName . " " . $this->faker->monthName,
            "type" => $this->faker->randomElement(['fixed', 'percent']),
            "start_date" => $this->faker->dateTimeBetween("- 5 days", "+ 5 days"),
            "end_date" => $this->faker->dateTimeBetween("+ 0 days", "+ 30 days"),
            "active" => true
        ];
    }
}
