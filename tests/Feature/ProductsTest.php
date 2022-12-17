<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductsTest extends TestCase
{
    use RefreshDatabase;
   
    public function testStoreNewProductBySellerUser()
    {
        $seller = User::factory()->create(['role' => 'seller']);
        $sellerToken= Auth::login($seller);
        $response = $this->withHeaders([
            'Authorization' => "bearer $sellerToken"
            ])->post('/api/products',[
                'name' => 'ahmed',
                'details' => 'ali@gh',
                'price' => '5555',
                'count' => '2',
                'seller_id' => $seller->id,
             ])
            ->assertJson([
                'error' => false,
            ]);
    }

    public function testUpdateProductBySellerUser()
    {
        $seller = User::factory()->create(['role' => 'seller']);
        $product = Product::factory()->create(['seller_id' => $seller->id]);
        $sellerToken=Auth::login($seller);
        $response = $this->withHeaders([
            'Authorization' => "bearer $sellerToken"
            ])->patchJson("/api/products/$product->id",[
                'name' => 'ahmed',
                'details' => 'ali@gh',
                'price' => '5555',
                'count' => '2',
                'seller_id' => $seller->id,
             ])
            ->assertJson([
                'error' => false,
            ]);
    }

    


}

   