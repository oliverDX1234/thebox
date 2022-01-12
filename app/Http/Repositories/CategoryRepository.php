<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function findById($id): Category
    {
        return Category::findOrFail($id);
    }


    public function getCategories()
    {
        return Category::all();
    }

    public function deleteCategory($id)
    {
        return Category::findOrFail($id)->delete();
    }


}
