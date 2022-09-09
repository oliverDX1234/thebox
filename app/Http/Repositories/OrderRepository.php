<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{

    public function findById($id): Order
    {
        return Order::where("id", $id)->with("packages.products", "user", "courier")->first();
    }

    public function getOrders($request)
    {
        $orders = Order::with("packages", "user", "courier");

        if($request->has("paymentTypes")){

            $orders->where("payment_type", "=", $request->paymentTypes);
        }

        if($request->has("users")){

            $orders->where("payment_type", "=", $request->paymentTypes);
        }

        return $orders->limit(10)->get();
    }

    public function deleteOrder($id)
    {
        Order::findOrFail($id)->delete();
    }


}
