<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\PackageRepositoryInterface;
use App\Models\Discount;
use App\Models\Package;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PackageService
{
    protected $packageRepository;

    public function __construct(
        PackageRepositoryInterface $packageRepository
    )
    {
        $this->packageRepository = $packageRepository;
    }

    /**
     * @throws ApiException
     */
    public function getPackages(Request $request)
    {
        try {
            return $this->packageRepository->getPackages(
                $request->categories,
                $request->statuses,
                $request->products,
                $request->discounts,
                $request->preMadeStatuses,
            );
        } catch (Exception $e) {
            throw new ApiException("global.error", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function getPackage(int $id): Package
    {
        try {
            $package = $this->packageRepository->findById($id);

            $package->load(["attributes.filter", "categories:id,name"]);

            $filters = [];

            foreach ($package->attributes as $attribute) {
                $filters[$attribute->filter->name][] = $attribute;
            }

            $package->filters = $filters;

            return $package;
        } catch (Exception $e) {
            throw new ApiException("packages.not_found", $e->getCode(), $e);
        }
    }


    /**
     * @throws ApiException
     */
    public function savePackage($request)
    {
        try {
            $package = Package::make($request->all());

            //URL, dimensions
            $package->url = slugify($request->name);

            $package->dimensions = json_encode([
                "width" => $request->width,
                "height" => $request->height,
                "length" => $request->length
            ]);

            $package->pre_made = true;

            //Package main image
            if ($request->file('main_image')) {
                $package->uploadMainImage($request->file('main_image'));
            }

            //Package Gallery Images
            $package->uploadGalleryImages($request->file('gallery_images'));

            //Package discount
            if ($request->price_discount !== null) {
                $discount = Discount::create([
                    "type" => "fixed",
                    "start_date" => Carbon::now()->toDateTimeLocalString(),
                    "end_date" => Carbon::now()->addYears(100)->toDateTimeLocalString(),
                    "value" => $request->price - $request->price_discount,
                    "active" => true
                ]);

                $package->discount_id = $discount->id;
            }

            $package->save();

            //Package Categories
            $categories = json_decode($request->categories);

            if ($categories) {
                foreach ($categories as $category) {
                    $package->categories()->attach($category->id);
                }
            }

            //Package Products
            $products = json_decode($request->products);

            if ($products) {
                foreach ($products as $product) {
                    $package->products()->attach($product->id);
                }
            }

            //Package Filters
            $filters = json_decode($request->get("attributes"));

            if ($filters) {
                foreach ($filters as $filter) {
                    foreach ($filter as $attribute) {
                        $package->attributes()->attach($attribute->id);
                    }
                }
            }

            $package->save();
        } catch (Exception $e) {
            throw new ApiException("packages.save_failed", 500, null, $e);
        }
    }


    /**
     * @throws ApiException
     */

    public function updatePackage($request)
    {
        try {

            $package = $this->packageRepository->findById($request->id);

            $package->update($request->all());

            //URL, dimensions
            $package->url = slugify($request->name);

            $package->dimensions = json_encode([
                "width" => $request->width,
                "height" => $request->height,
                "length" => $request->length
            ]);

            //Package main image
            if ($request->file('main_image')) {
                $package->uploadMainImage($request->file('main_image'));
            }

            //Package Gallery Images
            $package->uploadGalleryImages($request->file('gallery_images'), $request->old_image_ids);

            $package->save();

            //Package Discount
            if ($request->price_discount !== null) {

                if ($package->price_discount !== (int)$request->price_discount) {
                    $discount = Discount::create([
                        "type" => "fixed",
                        "start_date" => Carbon::now()->toDateTimeLocalString(),
                        "end_date" => Carbon::now()->addYears(100)->toDateTimeLocalString(),
                        "value" => $request->price - (int)$request->price_discount,
                        "active" => true
                    ]);

                    $package->discount_id = $discount->id;
                }
            } else {
                $package->discount_id = null;
            }

            //Package Categories
            $categories = json_decode($request->categories);
            $package->categories()->detach();

            if ($categories) {
                foreach ($categories as $category) {
                    $package->categories()->attach($category->id);
                }
            }

            //Package Products
            $products = json_decode($request->products);
            $package->products()->detach();
            if ($products) {
                foreach ($products as $product) {
                    $package->products()->attach($product->id);
                }
            }

            //Package Filters
            $filters = json_decode($request->get("attributes"));
            $package->attributes()->detach();

            if ($filters) {
                foreach ($filters as $filter) {
                    foreach ($filter as $attribute) {
                        $package->attributes()->attach($attribute->id);
                    }
                }
            }

            $package->save();

        } catch (Exception $e) {
            dd($e->getMessage());
            throw new ApiException("packages.update_failed", 500, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function deletePackage($id)
    {
        try {
            $this->packageRepository->deletePackage($id);
        } catch (Exception $e) {
            throw new ApiException("packages.not_found", 500, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function removePackageDiscount($id)
    {
        try {
            $this->packageRepository->removePackageDiscount($id);
        } catch (Exception $e) {
            throw new ApiException("package.discount_remove_failed", 500, $e);
        }
    }

}
