<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use App\Traits\ResponseAPI;

class ProductController extends Controller
{  
    use ResponseAPI;
    protected $productService;

	public function __construct(ProductService $productService)
	{
		$this->productService = $productService;
	}
    
    public function index()
    {
        try {
            $products =  $this->productService->getAllProducts();
            return $this->success("All Products", $products);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }

    }

    

    public function store(ProductRequest $request)
    {
        try {
            $product = $this->productService->CreateOrUpdateProduct($request,null);
            return $this->success("product created", $product, 201);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

 
    public function show(Product $product)
    {
        try {
            $product = $this->productService->getProductById($product->id);
            return $this->success("product Detail", $product);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }


    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product = $this->productService->CreateOrUpdateProduct($request, $product);
            return $this->success("product updated", $product, 200);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

   
    public function destroy(Product $product)
    {
        try {
            $product = $this->productService->deleteProduct($product->id);
            return $this->success("product deleted", $product);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

  
}
