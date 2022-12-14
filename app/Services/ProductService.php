<?php

namespace App\Services;

use App\Interfaces\ProductInterface;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    use ResponseAPI;
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
            $this->CheckIfThisUserWhoIsCreatedThisProductOrNot($product); 
            return $this->productInterface->CreateOrUpdateProduct($request, $product->id);
        } else {
            $this->CheckIfThisCurrentUserIsAsellerOrNot($product); 
            return $this->productInterface->CreateOrUpdateProduct($request);
        }
    }

    public function getProductById($id)
    {
        return $this->productInterface->getProductById($id);
    }


    public function deleteProduct($product)
    {
        $this->CheckIfThisUserWhoIsCreatedThisProductOrNot($product);
        return $this->productInterface->deleteProduct($product->id);
    }

    public function CheckIfThisUserWhoIsCreatedThisProductOrNot($product)
    {
        if (Auth::id() !== $product->user_id) {
            return $this->error('Product Not Belongs To This Seller', 404); 
         }
    }
    public function CheckIfThisCurrentUserIsAsellerOrNot()
    {
        if (Auth::user()->role !== 'seller') {
            return $this->error('This User Is Not A Seller', 404); 
         }
    }

}