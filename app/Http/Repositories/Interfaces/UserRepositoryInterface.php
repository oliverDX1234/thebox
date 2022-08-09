<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{

    public function findById(int $id): User;

    public function getUsers($request);

    public function deleteUser(int $id);

}
