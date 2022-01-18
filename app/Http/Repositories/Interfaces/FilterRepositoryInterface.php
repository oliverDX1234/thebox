<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Filter;

interface FilterRepositoryInterface
{
    public function findById(int $id): Filter;

    public function getFilters();

    public function deleteFilter(int $id);

}
