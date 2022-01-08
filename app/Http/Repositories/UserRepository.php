<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function findById($id): User
    {
        return User::findOrFail($id);
    }


    public function getUsers()
    {
        return User::all();
    }

    public function deleteUser($id)
    {
        return User::findOrFail($id)->delete();
    }


}
