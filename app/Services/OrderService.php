<?php

namespace App\Services;

use App\Interfaces\OrderInterface;
use App\Traits\ResponseToUser;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    use ResponseToUser;
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
            if (Auth::id() !== $order->buyer_id) {
                throw new \Exception('Order Not Belongs To This buyer', 404);
             }
            return $this->orderInterface->CreateOrUpdateOrder($request, $order->id);
        } else {
            if (Auth::user()->role !== 'buyer') {
                throw new \Exception('This User Is Not A buyer', 404);
             }
            return $this->orderInterface->CreateOrUpdateOrder($request);
        }
    }

    public function getOrderById($id)
    {
        return $this->orderInterface->getOrderById($id);
    }


    public function deleteOrder($order)
    {
        if (Auth::id() !== $order->buyer_id) {
            throw new \Exception('Order Not Belongs To This buyer', 404);
         }
        return $this->orderInterface->deleteOrder($order->id);
    }


}