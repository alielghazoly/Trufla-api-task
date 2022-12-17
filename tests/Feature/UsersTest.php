<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersTest extends TestCase
{
    use RefreshDatabase;
   
    public function testStoreNewUser()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'ali',
            'email' => 'ali@gh',
            'role' => 'buyer',
            'password' => '12345678',
        ]);
        $response
            ->assertJson([
                'error' => false,
            ]);
    }

    public function testUpdateUser()
    {
        $user = User::create([
            'name' => 'ali',
            'email' => 'ali@ali',
            'role' => 'seller',
            'password' => '12345678',
        ]);
        $this->put("/api/users/$user->id", [
            'name' => 'ahmed',
            'email' => 'ali@gh',
            'role' => 'buyer',
            'password' => '12345678',
        ])->assertJson([
                'error' => false,
            ]);
    }

    public function testLoginUser()
    {
        // first create user
        $user = User::create([
            'name' => 'ali',
            'email' => 'ali@ali',
            'role' => 'seller',
            'password' => '12345678',
        ]);
         $this->postJson('/api/users/login', [
            'email' => 'ali@ali',
            'password' => '12345678',
        ])->assertJson([
                'error' => false,
            ]);
    }
    
    public function testDeleteUser()
    {
        $user = User::factory()->create();
        $this->delete("/api/users/$user->id")->assertJson([
                'error' => false,
            ]);
    }

    public function testLogoutUser()
    {
        $user = User::factory()->create();
        $userToken=Auth::login($user);
        $this->withHeaders([
            'Authorization' => "bearer $userToken"
            ])->post('/api/users/logout')
                ->assertJson([
                    'error' => false,
                ]);
    }



}

   