<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\DiscountRepositoryInterface;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Package;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class DiscountService
{
    protected $discountRepository;

    public function __construct(
        DiscountRepositoryInterface $discountRepository
    )
    {
        $this->discountRepository = $discountRepository;
    }

    /**
     * @throws ApiException
     */
    public function getDiscounts($request)
    {
        try {
            return $this->discountRepository->getDiscounts($request);
        } catch (Exception $e) {
            throw new ApiException("global.error", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function getDiscount(int $id): Discount
    {
        try {
            return $this->discountRepository->findById($id);
        } catch (Exception $e) {
            throw new ApiException("discounts.not_found", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function saveDiscount($request)
    {
        try {

            if(!$request->end_date){
                $request->replace(array_merge($request->all(), ["end_date" => Carbon::now()->addYears(100)->toDateTimeLocalString()]));
            }

            $discount = Discount::create($request->all());

            $this->addProductsToDiscount($discount->id, $request->product_ids, $request->category_ids);

        } catch (Exception $e) {
            throw new ApiException("discounts.save_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function deleteDiscount($id)
    {
        try {
            $this->discountRepository->deleteDiscount($id);
        } catch (Exception $e) {
            throw new ApiException("discounts.not_found",  $e->getCode(), null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function getProductsForDiscount($id)
    {
        try {
            return $this->discountRepository->getProductsForDiscount($id);
        } catch (Exception $e) {
            throw new ApiException("discounts.discount_products_error",  $e->getCode(), null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function updateStatus($id)
    {
        try {
            return $this->discountRepository->updateStatus($id);
        } catch (Exception $e) {
            throw new ApiException("discounts.update_failed",  $e->getCode(), null, $e);
        }
    }

    public function createDiscountForSellable(Product|Package $sellable, int $originalPrice, int|null $priceDiscount): void
    {
        if ($priceDiscount === null) {
            $sellable->discount_id = null;
            return;
        }

        if ($sellable->price_discount !== $priceDiscount) {
            $discount = Discount::create([
                "type" => "fixed",
                "start_date" => Carbon::now()->toDateTimeLocalString(),
                "end_date" => Carbon::now()->addYears(100)->toDateTimeLocalString(),
                "value" => $originalPrice - $priceDiscount,
                "active" => true
            ]);

            $sellable->discount_id = $discount->id;
        }
    }

    private function addProductsToDiscount($discount_id, $product_ids = null, $category_ids = null)
    {

        if(count($category_ids)){

            $category_products = new Collection();

            foreach($category_ids as $id){
                $category_products = $category_products->merge(Category::where("id", $id)->with("products")->first()->products);
            }

            if(count($product_ids)){
                $category_products = $category_products->merge(Product::whereIn("id", $product_ids)->get());
            }

            $finalIds = $category_products->pluck("id")->toArray();

            Product::whereIn("id", $finalIds)->update([
                "discount_id" => $discount_id
            ]);
        }else if(count($product_ids)){
            Product::whereIn("id", $product_ids)->update([
                "discount_id" => $discount_id
            ]);
        }
    }

}
