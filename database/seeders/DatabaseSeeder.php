<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Supplier::factory(7, [])->create();
        Category::factory(7, [])->create();

        $this->call([
            CitiesMkTableSeeder::class,
            FilterSeeder::class,
            UsersTableSeeder::class,
            AttributesSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
