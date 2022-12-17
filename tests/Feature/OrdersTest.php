<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;
   
    public function testStoreNewOrderBybuyerUser()
    {
        $buyer = User::factory()->create(['role' => 'buyer']);
        $buyerToken=Auth::login($buyer);
        $response = $this->withHeaders([
            'Authorization' => "bearer $buyerToken"
            ])->post('/api/orders',[
                "payment_method" => "cash",
                'product_id' => 1,
             ])
            ->assertJson([
                'error' => false,
            ]);
    }

    public function testUpdateorderBybuyerUser()
    {
        $buyer = User::factory()->create(['role' => 'buyer']);
        $order = Order::factory()->create(['buyer_id' => $buyer->id]);
        $buyerToken=Auth::login($buyer);
        $response = $this->withHeaders([
            'Authorization' => "bearer $buyerToken"
            ])->patchJson("/api/orders/$order->id",[
                "payment_method" => "cash",
                'product_id' => 1,
             ])
            ->assertJson([
                'error' => false,
            ]);
    }

    


}

   