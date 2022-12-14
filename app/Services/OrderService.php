<?php

namespace App\Services;

use App\Interfaces\OrderInterface;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    use ResponseAPI;
    private $orderInterface;
    

    public function __construct(OrderInterface $orderInterface)
    {
        $this->orderInterface = $orderInterface;
    }

 
    public function getAllOrders()
    {
        return $this->orderInterface->getAllOrders();
    }

    public function CreateOrUpdateOrder($request,$order)
    {
        if ($order !== null) {
            $this->CheckIfThisUserWhoIsCreatedThisOrderOrNot($order); 
            return $this->orderInterface->CreateOrUpdateOrder($request, $order->id);
        } else {
            $this->CheckIfThisCurrentUserIsABuyerOrNot($order); 
            return $this->orderInterface->CreateOrUpdateOrder($request);
        }
    }

    public function getOrderById($id)
    {
        return $this->orderInterface->getOrderById($id);
    }


    public function deleteOrder($order)
    {
        $this->CheckIfThisUserWhoIsCreatedThisOrderOrNot($order);
        return $this->orderInterface->deleteOrder($order->id);
    }

    public function CheckIfThisUserWhoIsCreatedThisOrderOrNot($order)
    {
        if (Auth::id() !== $order->user_id) {
            return $this->error('order Not Belongs To This Seller', 404); 
         }
    }
    public function CheckIfThisCurrentUserIsABuyerOrNot()
    {
        if (Auth::user()->role !== 'buyer') {
            return $this->error('This User Is Not A buyer', 404); 
         }
    }

}