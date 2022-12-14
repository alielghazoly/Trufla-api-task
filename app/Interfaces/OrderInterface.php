<?php

namespace App\Interfaces;

interface OrderInterface
{
    public function getAllOrders();

    public function getOrderById($id);

    public function CreateOrUpdateOrder($request, $id = null);

    public function deleteOrder($id);
    
}