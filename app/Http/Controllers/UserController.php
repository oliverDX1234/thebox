<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->userService->getUsers();

        return response()->api(['users' => $users] , "users.retrieved", 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  UserStoreRequest  $request
     * @return Response
     */
    public function store(UserStoreRequest $request): Response
    {
        $this->userService->saveUser($request);

        return response()->api(null , "user.saved", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $user = $this->userService->getUser($id);

        return response()->api(['user' => $user], "user.retrieved", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param int $id
     * @return Response
     * @throws \App\Exceptions\ApiException
     */
    public function update(Request $request): Response
    {
        $this->userService->updateUser($request);

        return response()->api(null , "user.updated", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return response()->api(["user" => $id] , "user.deleted", 200);
    }
}
