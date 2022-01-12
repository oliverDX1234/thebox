<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        $url = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));

        return [
            'name' => $name,
            'url' => $url,
            'description' => $this->faker->paragraph(),
            'parent' => null,
            'seo_keywords' => "shopping, perfumes, discount, natural, gifts",
            'seo_description' => $this->faker->text(),
            'active' => true
        ];
    }
}
