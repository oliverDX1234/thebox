<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{

    public function findById($id): Order
    {
        return Order::where("id", $id)->with("packages", "user", "courier")->first();
    }

    public function getOrders($request)
    {
        $orders = Order::with("packages", "user", "courier");

        if($request->has("statuses")){

            $orders->where("active", "=", $request->statuses === "Active" ? 1 : 0);
        }

        return $orders->get();
    }

    public function deleteOrder($id)
    {
        Order::findOrFail($id)->delete();
    }


}
