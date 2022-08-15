<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\DiscountRepositoryInterface;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Carbon\Carbon;
use Exception;

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
            throw new ApiException("discount.not_found", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function saveDiscount($request)
    {

        try {
            if(!$request->end_date){
                $request->end_date = Carbon::create()->addYears(100)->toDateTimeLocalString();
            }

            $discount = Discount::create($request->all());

            $this->addProductsToDiscount($discount->id, $request->product_ids, $request->category_ids);

        } catch (Exception $e) {

            dd($e);
            throw new ApiException("discount.save_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function updateDiscount($request)
    {
        try {
            $discount = $this->discountRepository->findById($request->id);
        } catch (Exception $e) {
            throw new ApiException("discount.not_found", $e->getCode(), $e);
        }

        $discount->update($request->except('active'));

        $discount->active = json_decode($request->active);

        try {
            $discount->save();
        } catch (Exception $e) {
            throw new ApiException("discount.update_failed", 500, null, $e);
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

            throw new ApiException("discount.not_found",  $e->getCode(), null, $e);
        }
    }

    public function getProductsForDiscount($id)
    {
        try {
            return $this->discountRepository->getProductsForDiscount($id);
        } catch (Exception $e) {

            throw new ApiException("discount.discount_products_error",  $e->getCode(), null, $e);
        }
    }

    public function updateStatus($id)
    {
        try {
            return $this->discountRepository->updateStatus($id);
        } catch (Exception $e) {

            throw new ApiException("discount.update_failed",  $e->getCode(), null, $e);
        }
    }

    private function addProductsToDiscount($discount_id, $product_ids = null, $category_ids = null)
    {
        $p_ids = collect($product_ids)->pluck("id");
        $c_ids = collect($category_ids)->pluck("id");

        if(count($c_ids)){

            $category_products = [];

            foreach($c_ids as $id){
                $category_products = array_merge($category_products, [...Category::where("id", "=", $id)->with("products")->first()->products]);
            }

            if(count($p_ids)){
                $category_products = array_merge($category_products, [...Product::whereIn("id", $p_ids)->get()]);
            }

            $category_products = array_unique($category_products);

            $finalIds = array_unique(collect($category_products)->pluck("id")->toArray());

            Product::whereIn("id", $finalIds)->update([
                "discount_id" => $discount_id
            ]);
        }else if(count($p_ids)){
            Product::whereIn("id", $p_ids)->update([
                "discount_id" => $discount_id
            ]);
        }
    }

}
