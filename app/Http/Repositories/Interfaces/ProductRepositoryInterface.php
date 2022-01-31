<?php

namespace App\Http\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function findById($id);

    public function getProducts();

    public function deleteProduct($id);
}
