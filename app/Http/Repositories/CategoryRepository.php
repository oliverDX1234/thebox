<?php

namespace App\Http\Repositories;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Filter;
use Exception;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function findById($id): Category
    {
        return Category::findOrFail($id)->load("filters");
    }

    public function getCategories()
    {
        return Category::with("filters")->get();
    }

    public function getCategoriesForProduct()
    {
        return Category::with("filters")->select("id","name")->get();
    }

    /**
     * @throws Exception
     */
    public function deleteCategory($id)
    {
        if(Category::where("parent", $id)->first() != null){
            throw new Exception("category.has_more_items", 400);
        }

        $items = Category::find($id);

        if(!$items){
            throw new Exception("category.not_found", 404);
        }

        $items->delete();
    }


    public function getFiltersForCategories($ids)
    {
        return Filter::with("attributes")->join("category_filter", "filters.id", "=", "category_filter.filter_id")->whereIn("category_filter.category_id", $ids)->get();
    }

}
