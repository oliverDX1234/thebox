<?php

namespace App\Http\Services;

use App\Http\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function show($id)
    {
        $user = $this->userRepository->show($id);

        if ($user == null) {
            return [
                "data" => [
                    'status'  => 'error',
                    'message' => 'User not found'
                ],
                "code" => 404
            ];
        }

        return [
            "data" => [
                'status'  => 'success',
                "data" => $user
            ],
            "code" => 200
        ];
    }
}
