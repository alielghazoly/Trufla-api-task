<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use App\Services\UserService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseAPI;
    protected $userService;

	public function __construct(UserService $userService)
	{
		$this->userService = $userService;
	}

 
    public function index()
    {
        try {
            $users = $this->userService->getAllUsers();
            return $this->success("All Users", $users);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function store(UserRequest $request)
    {
        try {
            $user = $this->userService->requestUser($request);
            return $this->success("user created", $user, 201);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function show(UserRequest $user)
    {
        try {
            $user = $this->userService->getUserById($user->id);
            return $this->success("User Detail", $user);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $user = $this->userService->requestUser($request, $user->id);
            return $this->success("user updated", $user, 200);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function destroy(Request $user)
    {
        try {
            $user =  $this->userService->deleteUser($user->id);
            return $this->success("User deleted", $user);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = $this->userService->login($request);
            return $this->success("User logged in successfully", $user);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function logout(Request $request)
    {
        try {
           $response =  $this->userService->logout($request);
            return $this->success("User logged out successfully", $response, 401);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}