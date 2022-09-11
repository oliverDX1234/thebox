<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\PackageRepositoryInterface;
use App\Models\Package;
use Exception;
use Illuminate\Http\Request;

class PackageService
{
    private PackageRepositoryInterface $packageRepository;
    private DiscountService $discountService;

    public function __construct(
        PackageRepositoryInterface $packageRepository,
        DiscountService            $discountService
    )
    {
        $this->packageRepository = $packageRepository;
        $this->discountService = $discountService;
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
        $package = Package::make($request->all());
        //URL, dimensions
        $package->url = slugify($request->name);
        $package->active = !!$request->active;
        $package->pre_made = true;
        $this->setDimensions($request, $package);
        $this->setMedia($request, $package);
        $this->setDiscount($request, $package);
        $package->save();

        $this->setCategories($request, $package);
        $this->setProducts($request, $package);
        $this->setFilters($request, $package);

        $package->save();

        return $package;
    }


    /**
     * @throws ApiException
     */

    public function updatePackage(Request $request)
    {
        $package = $this->packageRepository->findById($request->id);

        $package->update($request->all());

        $package->active = !!$request->active;
        $package->url = slugify($request->name);
        $this->setDimensions($request, $package);
        $this->setMedia($request, $package);
        $this->setDiscount($request, $package);
        $package->save();

        $package->categories()->detach();
        $this->setCategories($request, $package);

        $package->products()->detach();
        $this->setProducts($request, $package);

        $package->attributes()->detach();
        $this->setFilters($request, $package);

        $package->save();
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

    private function setDimensions(Request $request, Package $package): void
    {
        $package->dimensions = json_encode([
            "width" => $request->width,
            "height" => $request->height,
            "length" => $request->length
        ]);
    }

    public function setMedia($request, Package $package): void
    {
        if ($request->file('main_image')) {
            $package->uploadMainImage($request->file('main_image'));
        }

        $package->uploadGalleryImages($request->file('gallery_images'), $request->old_image_ids);
    }

    private function setDiscount(Request $request, Package $package): void
    {
        $this->discountService->createDiscountForSellable(
            $package,
            $request->price,
            $request->price_discount,
            $request->discount_id
        );
    }

    private function setCategories(Request $request, Package $package): void
    {
        $categories = json_decode($request->categories);
        if ($categories) {
            foreach ($categories as $category) {
                $package->categories()->attach($category->id);
            }
        }
    }

    private function setProducts(Request $request, Package $package): void
    {
        $products = json_decode($request->products);
        if ($products) {
            foreach ($products as $product) {
                $package->products()->attach($product->id);
            }
        }
    }

    private function setFilters(Request $request, Package $package): void
    {
        $filters = json_decode($request->get("attributes"));
        if ($filters) {
            foreach ($filters as $filter) {
                foreach ($filter as $attribute) {
                    $package->attributes()->attach($attribute->id);
                }
            }
        }
    }


}
