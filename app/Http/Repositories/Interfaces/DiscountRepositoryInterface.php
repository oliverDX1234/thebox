<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Discount;

interface DiscountRepositoryInterface
{
    public function findById(int $id): Discount;

    public function getDiscounts(string $statuses, string $discountTypes, bool|null $showDefaults, bool|null $showSpecifics);

    public function deleteDiscount(int $id);

    public function getProductsForDiscount(int $id);

    public function updateStatus(int $id);
}
