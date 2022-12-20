<?php

namespace App\Repositories;

use App\Interfaces\OrderInterface;
use App\Models\Order;
use App\Models\Product;
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
            if(!$order) throw new \Exception("No order with ID $id", 404); 
            return $order;
    }
 
    public function CreateOrUpdateOrder($request, $id = null)
    {
            $order = $id ? Order::find($id) : new Order;
            if($id && !$order) throw new \Exception("No order with ID $id", 404); 
            $order->payment_method = $request->payment_method;
            $order->buyer_id = Auth::id();
            $order->save();
            $product = Product::find($request->product_id);
            if(!$product) throw new \Exception("No product with ID $request->product_id", 404);
            if(!$id) $order->products()->attach([$request->product_id]);
            return $order;
    }
 
    public function deleteOrder($id)
    {
            $order = Order::find($id);
            if(!$order)  throw new \Exception("No order with ID $id", 404); 
            $order->delete();
            return $order;
    }

}