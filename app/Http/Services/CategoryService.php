<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Exception;

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

        $category = Category::make($request->all());
        $category->save();

        try {
            $category->save();
        } catch (Exception $e) {
            throw new ApiException("category.save_failed", 500, null, $e);
        }
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

        try {
            $category->save();
        } catch (Exception $e) {
            throw new ApiException("category.update_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function deleteCategory($id)
    {
        try {
            $this->categoryRepository->deleteCategory($id);
        } catch (Exception $e) {
            throw new ApiException("category.not_found", 404, null, $e);
        }
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
                }else{
                    $d['children'] = [];
                }
                $tree[] = $d;
            }
        }
        return $tree;
    }


}
