<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use App\Traits\ResponseAPI;

class OrderController extends Controller
{
    use ResponseAPI;
    protected $orderService;

	public function __construct(OrderService $orderService)
	{
		$this->orderService = $orderService;
	}
    
    public function index()
    {
        try {
            $orders = $this->orderService->getAllOrders();
            return $this->success("All orders", $orders);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
    
    public function store(OrderRequest $request)
    {
        try {
            $order = $this->orderService->CreateOrUpdateOrder($request,null);
            return $this->success("order created", $order, 201);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
         
    }

   
    public function show(Order $order)
    {
        try {
            $order =  $this->orderService->getOrderById($order->id);
            return $this->success("order Detail", $order);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

  
    public function update(OrderRequest $request, Order $order)
    {
        try {
            $order = $this->orderService->CreateOrUpdateOrder($request, $order);
            return $this->success("order updated", $order, 200);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

   
    public function destroy(Order $order)
    {
        try {
            $order = $this->orderService->deleteOrder($order->id);
            return $this->success("order deleted", $order);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

}
