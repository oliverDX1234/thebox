<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\DiscountRepositoryInterface;
use App\Models\Discount;
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

        $discount = Discount::make($request->except('active'));
        $discount->active = json_decode($request->active);

        $discount->save();

        try {
            $discount->save();
        } catch (Exception $e) {
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

}
