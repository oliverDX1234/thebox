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
            'password' => "admin1234567",
            'roles' => 'admin',
            'admin_settings' => '{"layout":{"type":"vertical","width":"fluid","sidebartype":"dark","topbar":"dark","loader":"false"}}',
            'phone' => '+38971234567',
            'image' => 'http://127.0.0.1:8000/images/upload.png'
        ])->create();


        $this->call([
            CitiesMkTableSeeder::class,
        ]);
    }
}
