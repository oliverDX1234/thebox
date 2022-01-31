<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Exception;

class ProductService
{
    protected $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    )
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @throws ApiException
     */
    public function getProducts()
    {
        try {
            return $this->productRepository->getProducts();
        } catch (Exception $e) {
            throw new ApiException("global.error", 404, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function getProduct(int $id): Product
    {
        try {
            return $this->productRepository->findById($id);
        } catch (Exception $e) {
            throw new ApiException("product.not_found", 404, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function saveProduct($request)
    {

        $product = Product::make($request->except('active'));
        $product->active = json_decode($request->active);

        $product->save();

        try {
            $product->save();
        } catch (Exception $e) {
            throw new ApiException("product.save_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function updateProduct($request)
    {
        try {
            $product = $this->productRepository->findById($request->id);
        } catch (Exception $e) {
            throw new ApiException("product.not_found", 404, null, $e);
        }

        $product->update($request->except('active'));

        $product->active = json_decode($request->active);

        try {
            $product->save();
        } catch (Exception $e) {
            throw new ApiException("product.update_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function deleteProduct($id)
    {
        try {
            $this->productRepository->deleteProduct($id);
        } catch (Exception $e) {
            throw new ApiException("product.not_found", 404, null, $e);
        }
    }

}
