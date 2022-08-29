<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductService
{
    private $productRepository;
    private $discountService;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        DiscountService $discountService
    )
    {
        $this->productRepository = $productRepository;
        $this->discountService = $discountService;
    }

    /**
     * @throws ApiException
     */
    public function getProducts(Request $request)
    {
        try {
            return $this->productRepository->getProducts($request);
        } catch (Exception $e) {
            throw new ApiException("global.error", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function getProduct(int $id): Product
    {
        try {
            $product = $this->productRepository->findById($id);

            $product->load(["attributes.filter", "categories:id,name"]);

            $filters = [];

            foreach ($product->attributes as $attribute) {
                $filters[$attribute->filter->name][] = $attribute;
            }

            $product->filters = $filters;

            return $product;
        } catch (Exception $e) {
            throw new ApiException("products.not_found", $e->getCode(), $e);
        }
    }


    /**
     * @throws ApiException
     */
    public function saveProduct(Request $request)
    {
        try {
            $product = Product::make($request->all());

            //URL, suppliers, dimensions
            $product->url = slugify($request->name);
            $product->supplier_id = json_decode($request->supplier)->id;
            $this->setDimensions($request, $product);
            $this->setMedia($request, $product);
            $this->setDiscount($request, $product);
            $product->save();

            $this->setCategories($request, $product);
            $this->setFilters($request, $product);
            $product->save();
        } catch (Exception $e) {

            throw new ApiException("products.save_failed", 500, null, $e);
        }
    }


    /**
     * @throws ApiException
     */

    public function updateProduct(Request $request)
    {
        try {

            $product = $this->productRepository->findById($request->id);

            $product->update($request->all());

            //URL, suppliers, dimensions
            $product->url = slugify($request->name);
            $product->supplier_id = json_decode($request->supplier)->id;

            $this->setDimensions($request, $product);
            $this->setMedia($request, $product);
            $this->setDiscount($request, $product);
            $product->save();

            $product->categories()->detach();
            $this->setCategories($request, $product);

            $product->attributes()->detach();
            $this->setFilters($request, $product);

            $product->save();

        } catch (Exception $e) {
            throw new ApiException("products.update_failed", 500, $e);
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
            throw new ApiException("products.not_found", 500, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function removeProductDiscount($id)
    {
        try {
            $this->productRepository->removeProductDiscount($id);
        } catch (Exception $e) {
            throw new ApiException("product.discount_remove_failed", 500, $e);
        }
    }

    public function setDimensions(Request $request, Product $product): void
    {
        $product->dimensions = json_encode([
            "width" => $request->width,
            "height" => $request->height,
            "length" => $request->length
        ]);
    }

    public function setMedia(Request $request, Product $product): void
    {
        if ($request->file('main_image')) {
            $product->uploadMainImage($request->file('main_image'));
        }

        $product->uploadGalleryImages($request->file('gallery_images'), $request->old_image_ids);
    }

    public function setCategories(Request $request, Product $product): void
    {
        $categories = json_decode($request->categories);

        if ($categories) {
            foreach ($categories as $category) {
                $product->categories()->attach($category->id);
            }
        }
    }

    public function setFilters(Request $request, Product $product): void
    {
        $filters = json_decode($request->get("attributes"));

        if ($filters) {
            foreach ($filters as $filter) {
                foreach ($filter as $attribute) {
                    $product->attributes()->attach($attribute->id);
                }
            }
        }
    }


    private function setDiscount(Request $request, Product $product): void
    {
        $this->discountService->createDiscountForSellable(
            $product,
            $request->price,
            $request->price_discount
        );
    }

}
