<?php

namespace Database\Seeders;

use App\Models\User;
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
        //         \App\Models\User::factory(10)->create();
        User::factory([
            'email' => 'admin@thebox.com',
            'password' => bcrypt("admin1234567"),
            'roles' => 'admin',
            'admin_settings' => '{"layout":{"type":"vertical","width":"fluid","sidebartype":"dark","topbar":"dark","loader":"false"}}',
            'phone' => '+38971234567',
            'image' => 'https://t4.ftcdn.net/jpg/02/07/87/79/360_F_207877921_BtG6ZKAVvtLyc5GWpBNEIlIxsffTtWkv.jpg'

        ])->create();


        $this->call([


            CitiesMkTableSeeder::class,
        ]);
    }
}
