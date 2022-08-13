<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Discount;

interface DiscountRepositoryInterface
{

    public function findById(int $id): Discount;

    public function getDiscounts($request);

    public function deleteDiscount(int $id);

}
