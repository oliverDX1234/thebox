<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\ProductPrice;
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

            foreach($product->attributes as $attribute){
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
            $product = Product::make($request->except("price", "supplier_price", "discounted_price"));

            $product->url = slugify($request->name);
            $product->supplier_id = json_decode($request->supplier)->id;
            $product->dimensions = json_encode([
                "width" => $request->width,
                "height" => $request->height,
                "length" => $request->length
            ]);

            $product->active = !!$request->active;

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
                        ->toMediaCollection("gallery_images");
                    $i++;
                }
            }
            $product->save();

            ProductPrice::create([
                "product_id" => $product->id,
                "price" => $request->price,
                "supplier_price" => $request->supplier_price,
                "discounted_price" => $request->discounted_price
            ]);

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

            $product->update($request->except("active", "price", "supplier_price", "discounted_price"));

            $product->url = slugify($request->name);
            $product->supplier_id = json_decode($request->supplier)->id;
            $product->dimensions = json_encode([
                "width" => $request->width,
                "height" => $request->height,
                "length" => $request->length
            ]);

            ProductPrice::where("product_id", "=" , $product->id)->update([
                "price" => $request->price,
                "supplier_price" => $request->supplier_price,
                "discounted_price" => $request->discounted_price === "null" ? null : $request->discounted_price
            ]);

            $product->active = $request->active;

            if ($request->file('main_image')) {
                $product->addMediaFromRequest("main_image")
                    ->toMediaCollection("main_image");
            }

            $i = 0;
            $unchangedImages = [];

            $product->save();

            while (true) {

                if (!$request->file("gallery_image_" . $i) && !$request->has("gallery_image_" . $i)) {
                    break;
                }else if($request->has("gallery_image_" . $i)){
                    $image = json_decode($request->get("gallery_image_" . $i));

                    if(isset($image)){
                        $unchangedImages[] = $image->id;
                    }else{
                        $image = $product->addMediaFromRequest("gallery_image_" . $i)
                            ->toMediaCollection("gallery_images");

                        $unchangedImages[] = $image->id;
                    }

                    $i++;
                }
            }

            if($unchangedImages){

                $media = Media::where("collection_name", "gallery_images")->where("model_id", $product->id)->get();

                foreach($media as $i){

                    if(!in_array($i->id, $unchangedImages)){
                        $product->deleteMedia($i->id);
                    }
                }
            }

            $categories = json_decode($request->categories);
            $product->categories()->detach();
            if ($categories) {
                foreach ($categories as $category) {
                    $product->categories()->attach($category->id);
                }
            }

            $filters = json_decode($request->get("attributes"));
            $product->attributes()->detach();

            if ($filters) {
                foreach ($filters as $filter) {
                    foreach ($filter as $attribute) {
                        $product->attributes()->attach($attribute->id);
                    }
                }
            }

            $product->active = json_decode($request->active);

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

}
