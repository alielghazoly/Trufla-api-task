<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;

class UserService
{

    private $userInterface;
    

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

 
    public function getAllUsers()
    {
        return $this->userInterface->getAllUsers();
    }

    public function requestUser($request,$id = null)
    {
        return $this->userInterface->requestUser($request, $id);
    }

    public function getUserById($id)
    {
        return $this->userInterface->getUserById($id);
    }


    public function deleteUser($id)
    {
        return $this->userInterface->deleteUser($id);
    }

    public function login($request)
    {
        return $this->userInterface->login($request);
    }

    public function logout($request)
    {
        return $this->userInterface->logout($request);
    }

}