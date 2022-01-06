<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserService
{
    protected $userRepository;
    protected $imageService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ImageService  $imageService
    )
    {
        $this->userRepository = $userRepository;
        $this->imageService = $imageService;
    }

    public function getUser(int $id): User
    {
        try {
            return $this->userRepository->findById($id);
        } catch (\Exception $e) {
            throw new ApiException("user.not_found", 404, null, $e);
        }
    }

    public function saveUser($request)
    {
        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->dob = $request->dob;

        $this->imageService->storeImage($request->file("image"));
        dd($user);

    }
}
