<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements ProductInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    public function getAllProducts()
    {
            return Product::all();
    }

    public function getProductById($id)
    {
            $product = Product::find($id);
            if(!$product) return $this->error("No product with ID $id", 404);
            return $product;
    }

    public function CreateOrUpdateProduct($request, $id = null)
    {
            $product = $id ? Product::find($id) : new Product;
            if($id && !$product) return $this->error("No product with ID $id", 404);
            $product->name = $request->name;
            $product->details = $request->details;
            $product->price = $request->price;
            $product->count = $request->count;
            $product->seller_id = Auth::id();
            $product->save();
            return $product;
    }

    public function deleteProduct($id)
    {
            $product = Product::find($id);
            if(!$product) return $this->error("No product with ID $id", 404);
            $product->delete();
            return $product;
    }

}