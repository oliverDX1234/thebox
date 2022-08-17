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

    public function getUsers($request)
    {
        $users = User::query();

        if($request->has("statuses")){

            $users->where("active", "=", $request->statuses === "Active" ? 1 : 0);
        }


        if($request->has("roles")){
            $users->where("roles", "=", $request->roles === "Admin" ? "admin" : "user");
        }

        return $users->get();
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
    }


}
