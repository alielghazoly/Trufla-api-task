<?php

namespace App\Services;

use App\Interfaces\ProductInterface;
use App\Traits\ResponseToUser;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    use ResponseToUser;
    private $productInterface;
    

    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    }

 
    public function getAllProducts()
    {
        return $this->productInterface->getAllProducts();
    }

    public function CreateOrUpdateProduct($request,$product)
    {
        if ($product !== null) {
            if (Auth::id() !== $product->seller_id) {
                return $this->coreResponse('Product Not Belongs To This Seller',null, 404);
             }
            return $this->productInterface->CreateOrUpdateProduct($request, $product->id);
        } else {
            if (Auth::user()->role !== 'seller') {
                return $this->coreResponse('This User Is Not A Seller',null, 404);
             }
            return $this->productInterface->CreateOrUpdateProduct($request);
        }
    }

    public function getProductById($id)
    {
        return $this->productInterface->getProductById($id);
    }


    public function deleteProduct($product)
    {
        if (Auth::id() !== $product->seller_id) {
            return $this->coreResponse('Product Not Belongs To This Seller',null, 404);
         }
        return $this->productInterface->deleteProduct($product->id);
    }

    

}