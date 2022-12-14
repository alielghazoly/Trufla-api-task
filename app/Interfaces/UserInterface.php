<?php

namespace App\Interfaces;

interface UserInterface
{
    public function getAllUsers();

    public function getUserById($id);

    public function requestUser($request, $id = null);

    public function deleteUser($id);

    public function login($request);

    public function logout($request);
}