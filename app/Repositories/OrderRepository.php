<?php

namespace App\Repositories;

use App\Interfaces\OrderInterface;
use App\Models\Order;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Auth;

class OrderRepository implements OrderInterface
{
    use ResponseAPI;

    public function getAllOrders()
    {
            return Order::all();
    }

    public function getOrderById($id)
    {
            $order = Order::find($id);
            if(!$order) return $this->error("No order with ID $id", 404);
            return $order;
    }
 
    public function CreateOrUpdateOrder($request, $id = null)
    {
            $order = $id ? Order::find($id) : new Order;
            if($id && !$order) return $this->error("No order with ID $id", 404);
            $order->payment_method = $request->payment_method;
            $order->buyer_id = Auth::id();
            $order->save();
            return $order;
    }
 
    public function deleteOrder($id)
    {
            $order = Order::find($id);
            if(!$order) return $this->error("No order with ID $id", 404);
            $order->delete();
            return $order;
    }

}