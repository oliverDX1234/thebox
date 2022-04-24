<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Exception;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

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
        try {
            $product = Product::make($request->except('active'));
            $product->url = slugify($request->name);
            $product->supplier_id = json_decode($request->supplier)->id;
            $product->dimensions = json_encode([
                "width" => $request->width,
                "height" => $request->height,
                "length" => $request->length
            ]);
            $product->supplier_price = $request->supplier_price;
            $product->active = 1;

            if ($request->file('main_image')) {
                $product->addMediaFromRequest("main_image")
                    ->toMediaCollection("main_image");
            }

            $i = 0;

            while (true) {

                if (!$request->file("gallery_image_" . $i)) {
                    break;
                } else {
                    $product->addMediaFromRequest("gallery_image_" . $i)
                        ->toMediaCollection("gallery_image_" . $i);
                    $i++;
                }
            }

            $product->save();

            $categories = json_decode($request->categories);

            if ($categories) {
                foreach ($categories as $category) {
                    $product->categories()->attach($category->id);
                }
            }

            $filters = json_decode($request->get("attributes"));

            if ($filters) {
                foreach ($filters as $filter) {
                    foreach ($filter as $attribute) {
                        $product->attributes()->attach($attribute->id);
                    }
                }
            }

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
