<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(["Shatze", "Swarovski", "Biblioteka", "Literatura", "Tinex", "DukiDaso", "DM"]),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address,
            'city_id' => $this->faker->numberBetween($min = 1, $max = 36),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
