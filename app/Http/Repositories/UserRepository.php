<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function show($id)
    {
        return User::find($id);
    }
}
