<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Category;

interface CategoryRepositoryInterface
{

    public function findById(int $id): Category;

    public function getCategories();

    public function deleteCategory(int $id);

    public function getFiltersForCategories($ids);

}
