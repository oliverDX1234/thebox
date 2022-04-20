<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @throws ApiException
     */
    public function getCategories()
    {
        try {
            return $this->categoryRepository->getCategories();
        } catch (Exception $e) {
            throw new ApiException("global.error", 404, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function getCategory(int $id): Category
    {
        try {
            return $this->categoryRepository->findById($id);
        } catch (Exception $e) {
            throw new ApiException("category.not_found", 404, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function saveCategory($request)
    {
        $items = $request->all();
        $filters = isset($items["filters"]) ? collect($items["filters"])->pluck("id")->toArray() : [];
        $items["url"] = slugify($request->name);
        $category = Category::make($items);
        $category->save();
        $category->filters()->sync($filters);

        try {
            $category->save();
        } catch (Exception $e) {
            throw new ApiException("category.save_failed", 500, null, $e);
        }
        return $category;
    }

    /**
     * @throws ApiException
     */
    public function updateCategory($request)
    {
        try {
            $category = $this->categoryRepository->findById($request->id);
        } catch (Exception $e) {
            throw new ApiException("category.not_found", 404, null, $e);
        }

        $items = $request->all();
        $filters = isset($items["filters"]) ? collect($items["filters"])->pluck("id")->toArray() : [];
        $items["url"] = slugify($request->name);

        $category->filters()->sync($filters);
        $category->update($items);

        try {
            $category->save();
        } catch (Exception $e) {
            throw new ApiException("category.update_failed", 500, null, $e);
        }

        return $category;
    }
    /**
     * @throws ApiException
     */
    public function deleteCategory($id)
    {
        try {
            $this->categoryRepository->deleteCategory($id);
        } catch (Exception $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function saveCategories($tree)
    {
        try {
            $flattened = $this->flatten($tree);

            foreach ($flattened as $i) {
                Category::findOrFail($i["id"])->update([
                    "parent" => ($i["parent"] == "/") ? null : $i["parent"]
                ]);
            }

        } catch (Exception $e) {
            throw new ApiException("global.error", 404, null, $e);
        }
    }
    public function flatten($element, $parent_nodes = 0): array
    {
        $flatArray = array();
        foreach ($element as $key => $node) {
            if (array_key_exists('children', $node) && count($node['children']) != 0) {
                $flatArray = array_merge($flatArray, $this->flatten($node['children'], $node["id"]));

                unset($node['children']);
                $node["parent"] = $parent_nodes;
                $flatArray[] = $node;

            } else {

                $node["parent"] = $parent_nodes;
                $flatArray[] = $node;
            }
        }


        return $flatArray;
    }


    public function getCategoriesTree(): array
    {
        try {
            $categories = $this->categoryRepository->getCategories();

            $tree = $this->buildTree($categories->toArray());
        } catch (Exception $e) {
            throw new ApiException("global.error", 404, null, $e);
        }

        return $tree;
    }

    private function buildTree(array $data, $parent = 0): array
    {
        $tree = array();
        foreach ($data as $d) {
            if ($d['parent'] == $parent) {
                $children = $this->buildTree($data, $d['id']);
                // set a trivial key
                if (!empty($children)) {
                    $d['children'] = $children;
                } else {
                    $d['children'] = [];
                }
                $tree[] = $d;
            }
        }
        return $tree;
    }


    public function getFiltersForCategories($request)
    {
        try {
            $categoryIds = collect($request->categories)->pluck("id")->toArray();

            $filtersAndCategories = $this->categoryRepository->getFiltersForCategories($categoryIds)->unique();
            $filters = $filtersAndCategories->pluck("name")->toArray();
            $attributes = $filtersAndCategories->pluck("attributes");

            $data = [
                "filtersAndCategories" => $filtersAndCategories,
                "filters" => $filters,
                "attributes" => $attributes
            ];

            return $data;
        } catch (Exception $e) {
            throw new ApiException("global.error", 404, null, $e);
        }
    }


}
