<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Services\CategoryService;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws ApiException
     */
    public function index(): Response
    {
        $categories = $this->categoryService->getCategories();

        return response()->api(['categories' => $categories] , "categories.retrieved", 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function store(CategoryStoreRequest $request): Response
    {
        $this->categoryService->saveCategory($request);

        return response()->api(null , "category.saved", 200);
    }

    /**
     * Display the specified resource.
     * @throws ApiException
     */
    public function show(int $id): Response
    {
        $category = $this->categoryService->getCategory($id);

        return response()->api(['category' => $category], "category.retrieved", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function update(CategoryStoreRequest $request): Response
    {
        $this->categoryService->updateCategory($request);

        return response()->api(null , "category.updated", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws ApiException
     */
    public function destroy(int $id): Response
    {
        $this->categoryService->deleteCategory($id);

        return response()->api(["category" => $id] , "category.deleted", 200);
    }


    /**
     * @throws ApiException
     */
    public function getCategoriesTree(): Response
    {
        $categories = $this->categoryService->getCategoriesTree();

        return response()->api(["categories" => $categories] , "categories.retrieved", 200);
    }
}
