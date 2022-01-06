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

    public function getUser(int $id): User
    {
        try {
            return $this->userRepository->findById($id);
        } catch (\Exception $e) {
            throw new ApiException("user.not_found", 404, null, $e);
        }
    }
}
