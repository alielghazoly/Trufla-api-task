<?php

namespace App\Interfaces;

interface ProductInterface
{
    public function getAllProducts();

    public function getProductById($id);

    public function CreateOrUpdateProduct($request, $id = null);

    public function deleteProduct($id);
    
}