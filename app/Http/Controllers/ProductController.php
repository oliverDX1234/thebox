<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     * @throws ApiException
     */
    public function index(Request $request): Response
    {

        $products = $this->productService->getProducts($request);

        return response()->api(['products' => $products] , "products.retrieved", 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function store(ProductStoreRequest $request): Response
    {
        $this->productService->saveProduct($request);

        return response()->api(null , "products.saved", 200);
    }

    /**
     * Display the specified resource.
     * @throws ApiException
     */
    public function show(int $id): Response
    {
        $product = $this->productService->getProduct($id);

        return response()->api(['product' => $product], "products.retrieved", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function update(ProductStoreRequest $request): Response
    {
        $this->productService->updateProduct($request);

        return response()->api(null , "products.updated", 200);
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
        $this->productService->deleteProduct($id);

        return response()->api(["product" => $id] , "products.deleted", 200);
    }

    /**
     * @throws ApiException
     */
    public function removeProductDiscount($id)
    {
        $this->productService->removeProductDiscount($id);

        return response()->api(null , "products.discount_successfully_removed", 200);
    }
}
