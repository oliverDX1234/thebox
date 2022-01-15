<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Exception;

class UserService
{
    protected $userRepository;
    protected $imageService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ImageService            $imageService
    )
    {
        $this->userRepository = $userRepository;
        $this->imageService = $imageService;
    }

    public function getUsers()
    {
        try {
            return $this->userRepository->getUsers();
        } catch (Exception $e) {
            throw new ApiException("global.error", 404, null, $e);
        }
    }

    public function getUser(int $id): User
    {
        try {
            return $this->userRepository->findById($id);
        } catch (Exception $e) {
            throw new ApiException("user.not_found", 404, null, $e);
        }
    }

    public function saveUser($request)
    {

        $user = User::make($request->except(['image', 'active', '_method']));

        $user->active = json_decode($request->active);

        $user->save();

        if ($request->file('imageInput')) {
            $user->addMediaFromRequest("imageInput")
                ->toMediaCollection("avatar");
            $user->image = $user->getFirstMedia("avatar")->getUrl();
        }else{
            $user->image = env("APP_URL")."/images/upload.png";
        }

        try {
            $user->save();
        } catch (Exception $e) {
            throw new ApiException("user.save_failed", 500, null, $e);
        }
    }

    public function updateUser($request)
    {
        try {
            $user = $this->userRepository->findById($request->id);
        } catch (Exception $e) {
            throw new ApiException("user.not_found", 404, null, $e);
        }
        $user->update($request->except(['image', 'active', '_method']));

        $user->active = json_decode($request->active);

        if ($request->file('imageInput')) {
            $user->addMediaFromRequest("imageInput")
                ->toMediaCollection("avatar");
            $user->image = $user->getFirstMedia("avatar")->getUrl();
        }

        try {
            $user->save();
            return $user;
        } catch (Exception $e) {
            throw new ApiException("user.update_failed", 500, null, $e);
        }
    }

    public function deleteUser($id)
    {
        try {
            $this->userRepository->deleteUser($id);
        } catch (Exception $e) {
            throw new ApiException("user.not_found", 404, null, $e);
        }
    }

}
