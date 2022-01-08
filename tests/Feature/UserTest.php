<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;

    public function test_patch_user()
    {
        $user = User::find(1);

        $request = $user->toArray();
        $request['last_name'] = $this->faker->firstName();
        $request['city'] = 1;

        $response = $this
            ->actingAs($user, 'sanctum')
            ->json('patch', '/api/user/1', $request);

        $response->assertStatus(200);
        $user = User::find(1);
        $this->assertEquals($user->last_name, $request['last_name']);
    }

    public function test_post_user()
    {
        $admin = User::find(1);

        $request = User::factory()->make(/*[
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'confirmPassword' => 'password',
            'city' => 1
        ]*/);

        $request = $request->toArray();
        $request['password'] = 'password';
        $request['confirmPassword'] = 'password';
        $request['city'] = 1;

        $response = $this
            ->actingAs($admin, 'sanctum')
            ->json('post', '/api/user', $request);

        $response->assertStatus(200);

        $user = User::find(['email' => $request['email']])->first()->toArray();

        $this->assertEquals($user['email'], $request['email']);
        $this->assertEquals($user['first_name'], $request['first_name']);
    }
}
