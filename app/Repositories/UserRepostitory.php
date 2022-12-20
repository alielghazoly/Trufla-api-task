<?php

namespace App\Repositories;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Traits\ResponseAPI;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;
 
    public function getAllUsers()
    {
            return User::all();
    }

    public function getUserById($id)
    {
            $user = User::find($id);
            if(!$user) throw new \Exception("No user with ID $id", 404); 
            return $user;
    }

    public function requestUser($request, $id = null)
    {
            $user = $id ? User::find($id) : new User;
            if($id && !$user) throw new \Exception("No user with ID $id", 404); 
            $user->name = $request->name;
            $user->email = $request->email;
            if(!$id) $user->password = Hash::make($request->password);
            $user->save();
            return $user;
    }

    public function deleteUser($id)
    {
            $user = User::find($id);
            if(!$user)  throw new \Exception("No user with ID $id", 404); 
            $user->delete();
            return $user;
    }

    public function login($request)
    {
            $credentials = $request->only('email', 'password');
            $token = Auth::attempt($credentials);
            if(!$token) throw new \Exception("Unauthorized user", 401);
            $user = Auth::user();
            $user['token'] = $token;
            return $user;
    }

    public function logout($request)
    {
      return  Auth::logout();
    }
}