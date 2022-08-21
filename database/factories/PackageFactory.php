<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->word();

        $discount = rand() % 2 === 0;

        return [
            "name" => $name,
            "url" => slugify($name),
            "short_description" => $this->faker->text(),
            "description" => $this->faker->randomHtml(),
            "dimensions" => '{"width":300,"height":300,"length":300}',
            "unit_code" => $this->faker->randomNumber(),
            "vat" => "18",
            "weight" => $this->faker->numberBetween($min = 1, $max = 7),
            'seo_title' => $this->faker->word(),
            'seo_keywords' => "shopping, perfumes, discount, natural, gifts",
            'seo_description' => $this->faker->sentence(),
            "price" => $this->faker->numberBetween($min = 100, $max = 500),
            "discount_id" => $discount ? $this->faker->numberBetween($min = 1, $max = 7) : null,
            'active' => true
        ];
    }
}
