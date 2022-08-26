<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Discount;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
    public function getProducts($request)
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
    public function saveProduct($request)
    {
        try {
            $product = Product::make($request->all());

            //URL, suppliers, dimensions
            $product->url = slugify($request->name);
            $product->supplier_id = json_decode($request->supplier)->id;
            $product->dimensions = json_encode([
                "width" => $request->width,
                "height" => $request->height,
                "length" => $request->length
            ]);

            $product->active = !!$request->active;

            //Product main image
            if ($request->file('main_image')) {
                $product->addMediaFromRequest("main_image")
                    ->toMediaCollection("main_image");
            }

            foreach ($request->file('gallery_images') ?? [] as $galleryImage) {
                $product
                    ->addMedia($galleryImage)
                    ->toMediaCollection("gallery_images");
            }

            //Product discount
            if ($request->price_discount !== null) {
                $discount = Discount::create([
                    "type" => "fixed",
                    "start_date" => Carbon::now()->toDateTimeLocalString(),
                    "end_date" => Carbon::now()->addYears(100)->toDateTimeLocalString(),
                    "value" => $request->price - $request->price_discount,
                    "active" => true
                ]);

                $product->discount_id = $discount->id;
            }

            $product->save();

            //Product Categories
            $categories = json_decode($request->categories);

            if ($categories) {
                foreach ($categories as $category) {
                    $product->categories()->attach($category->id);
                }
            }

            //Product Filters
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

            throw new ApiException("products.save_failed", 500, null, $e);
        }
    }


    /**
     * @throws ApiException
     */

    public function updateProduct($request)
    {
        try {

            $product = $this->productRepository->findById($request->id);

            $product->update($request->all());

            //URL, suppliers, dimensions
            $product->url = slugify($request->name);
            $product->supplier_id = json_decode($request->supplier)->id;
            $product->dimensions = json_encode([
                "width" => $request->width,
                "height" => $request->height,
                "length" => $request->length
            ]);


            $product->active = !!$request->active;

            //Delete gallery images
            $media = Media::where("collection_name", "gallery_images")->where("model_id", $product->id)->get();
            foreach ($media as $i) {
                if(!in_array($i->id, json_decode($request->old_image_ids))){
                    $product->deleteMedia($i->id);
                }
            }

            //Add gallery images
            foreach ($request->file('gallery_images') ?? [] as $galleryImage) {
                $product
                    ->addMedia($galleryImage)
                    ->toMediaCollection("gallery_images");
            }

            $product->save();

            //Product Discount
            if ($request->price_discount !== null) {

                if ($product->price_discount !== (int)$request->price_discount) {
                    $discount = Discount::create([
                        "type" => "fixed",
                        "start_date" => Carbon::now()->toDateTimeLocalString(),
                        "end_date" => Carbon::now()->addYears(100)->toDateTimeLocalString(),
                        "value" => $request->price - (int)$request->price_discount,
                        "active" => true
                    ]);

                    $product->discount_id = $discount->id;
                }
            } else {
                $product->discount_id = null;
            }

            //Product Categories
            $categories = json_decode($request->categories);
            $product->categories()->detach();
            if ($categories) {
                foreach ($categories as $category) {
                    $product->categories()->attach($category->id);
                }
            }

            //Product Filters
            $filters = json_decode($request->get("attributes"));
            $product->attributes()->detach();

            if ($filters) {
                foreach ($filters as $filter) {
                    foreach ($filter as $attribute) {
                        $product->attributes()->attach($attribute->id);
                    }
                }
            }

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

}
