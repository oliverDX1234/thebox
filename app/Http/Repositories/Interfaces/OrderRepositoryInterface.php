<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function findById(int $id): Order;

    public function getOrders($filter = null, $sortBy = "id", $sortDesc = false, $perPage = 10, $currentPage = 1, $paymentTypes = null, $paidStatuses = null);

    public function deleteOrder(int $id);

}
