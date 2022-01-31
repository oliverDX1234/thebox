<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Services\ProductService;
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
     * @return Response
     * @throws ApiException
     */
    public function index(): Response
    {

        $products = $this->productService->getProducts();

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

        return response()->api(null , "product.saved", 200);
    }

    /**
     * Display the specified resource.
     * @throws ApiException
     */
    public function show(int $id): Response
    {
        $product = $this->productService->getProduct($id);

        return response()->api(['product' => $product], "product.retrieved", 200);
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

        return response()->api(null , "product.updated", 200);
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

        return response()->api(["product" => $id] , "product.deleted", 200);
    }
}
