<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word();
        return [
            "name" => $name,
            "url" => slugify($name),
            "supplier_id" => $this->faker->numberBetween($min = 1, $max = 7),
            "short_description" => $this->faker->text(),
            "description" => $this->faker->randomHtml(),
            "dimensions" => '{"width":300,"height":300,"length":300}',
            "unit_code" => $this->faker->randomNumber(),
            "vat" => "18",
            "weight" => $this->faker->numberBetween($min = 1, $max = 7),
            'seo_title' => $this->faker->word(),
            'seo_keywords' => "shopping, perfumes, discount, natural, gifts",
            'seo_description' => $this->faker->sentence(),
            'active' => true

        ];
    }
}
