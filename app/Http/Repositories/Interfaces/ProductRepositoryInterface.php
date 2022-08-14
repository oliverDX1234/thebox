<?php

namespace App\Http\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function findById($id);

    public function getProducts($request);

    public function deleteProduct($id);

    public function removeProductDiscount($id);
}
