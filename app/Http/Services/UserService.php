<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Exception;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class UserService
{
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws ApiException
     */
    public function getUsers($request)
    {
        try {
            return $this->userRepository->getUsers($request);
        } catch (Exception $e) {
            throw new ApiException("global.error", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function getUser(int $id): User
    {
        try {
            return $this->userRepository->findById($id);
        } catch (Exception $e) {
            throw new ApiException("user.not_found", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function saveUser($request)
    {
        try {

            $user = User::make($request->except(['image', 'active', '_method']));

            $user->active = json_decode($request->active);

            $user->save();

            if ($request->file('imageInput')) {
                $user->addMediaFromRequest("imageInput")
                    ->toMediaCollection("avatar");
                $user->image = $user->getFirstMedia("avatar")->getUrl();
            } else {
                $user->image = env("APP_URL") . "/images/upload.png";
            }


            $user->save();
        } catch (Exception $e) {
            throw new ApiException("user.save_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function updateUser($request): User
    {
        try {
            $user = $this->userRepository->findById($request->id);
        } catch (Exception $e) {
            throw new ApiException("user.not_found", $e->getCode(), $e);
        }

        try {

            $user->update($request->except(['image', 'active', '_method']));

            $user->active = json_decode($request->active);

            if ($request->file('imageInput')) {
                $user->addMediaFromRequest("imageInput")
                    ->toMediaCollection("avatar");
                $user->image = $user->getFirstMedia("avatar")->getUrl();
            }

            $user->save();

            return $user;
        } catch (Exception $e) {
            throw new ApiException("user.update_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function deleteUser($id)
    {
        try {
            $this->userRepository->deleteUser($id);
        } catch (Exception $e) {
            throw new ApiException("user.not_found", $e->getCode(), $e);
        }
    }

}
