<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function findById(int $id): Order;

    public function getOrders($request);

    public function deleteOrder(int $id);

}
