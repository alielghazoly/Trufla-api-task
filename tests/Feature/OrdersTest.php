<?php

namespace Tests\Feature;

use App\Http\Controllers\ProductController;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Mockery\MockInterface;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;
   
    public function testStoreNewOrderBybuyerUser()
    {
        $buyer = User::factory()->create(['role' => 'buyer']);
        $seller = User::factory()->create(['role' => 'seller']);
        $order = Order::factory()->create(['buyer_id' => $buyer->id]);
        $product = Product::factory()->create(['seller_id' => $seller->id]);
        $buyerToken=Auth::login($buyer);
        $response = $this->withHeaders([
            'Authorization' => "bearer $buyerToken"
            ])->post('/api/orders',[
                "payment_method" => "cash",
                'product_id' => $product->id,
             ])
            ->assertJson([
                'error' => false,
            ]);
    }

    public function testUpdateorderBybuyerUser()
    {
        $buyer = User::factory()->create(['role' => 'buyer']);
        $seller = User::factory()->create(['role' => 'seller']);
        $order = Order::factory()->create(['buyer_id' => $buyer->id]);
        $product = Product::factory()->create(['seller_id' => $seller->id]);
        $buyerToken=Auth::login($buyer);
        $response = $this->withHeaders([
            'Authorization' => "bearer $buyerToken"
            ])->patchJson("/api/orders/$order->id",[
                "payment_method" => "cash",
                'product_id' => $product->id,
                ]) 
                ->assertJson([
                    'error' => false,
                ]);
               
     }

           


}

   