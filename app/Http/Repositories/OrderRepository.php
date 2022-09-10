<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\City;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{

    public function findById($id): Order
    {
        return Order::where("id", $id)->with("packages.products", "user", "courier")->first();
    }

    public function getOrders($filter = null, $sortBy = "id", $sortDesc = false, $perPage = 10, $currentPage = 1, $paymentTypes = null, $paidStatuses = null)
    {
        $orders = Order::with("packages", "user", "courier");
        if($paymentTypes){

            $orders->where("payment_type", "=", $paymentTypes);
        }
        if($paidStatuses){

            $orders->where("paid", "=", $paidStatuses === "Paid" ? 1 : 0);
        }


        if($filter && $filter !== ""){
            $city_id = City::where("city_name_en", "like", "%". $filter . "%")->first();
            $city_id = $city_id ? $city_id->id : null;
            $orders->where(function($q) use ($filter, $city_id){
                $q->where("order_number", "like", "%". $filter. "%")
                    ->orWhere("total_price", "like", "%". $filter. "%")
                    ->orWhereHas("user", function($query) use ($filter){
                        $query->where("first_name", "like", "%". $filter. "%")
                            ->orWhere("last_name", "like", "%". $filter. "%");
                    })
                ->orWhere('user_shipping_details->first_name', "like", "%". $filter . "%")
                    ->orWhere('user_shipping_details->last_name', "like", "%". $filter . "%")
                    ->orWhere('user_shipping_details->email', "like", "%". $filter . "%")
                    ->orWhere('user_shipping_details->phone' , "like", "%". $filter . "%")
                    ->orWhere('user_shipping_details->address' , "like", "%". $filter . "%")
                    ->orWhere('user_shipping_details->city' , $city_id ?? "");
            });
        }

        $total = $orders->count();

        $orders->orderBy($sortBy != "" ? $sortBy : "id", $sortDesc === false ? "ASC" : "DESC");

        return [$orders->skip((($currentPage) - 1) * $perPage)->take($perPage)->get(), $total];
    }

    public function deleteOrder($id)
    {
        Order::findOrFail($id)->delete();
    }


}
