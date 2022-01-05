<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUser($id): User
    {
        try {
            return $this->userRepository->findById($id);
        } catch (\Exception $e) {
            throw new ApiException("User with that id not found", 404, $e);
        }
    }
}
