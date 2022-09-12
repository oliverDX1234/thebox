<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Services\DiscountService;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    protected $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    /**
     * @throws ApiException
     */
    public function index(Request $request)
    {
        $discounts = $this->discountService->getDiscounts($request);

        return response()->api(['discounts' => $discounts] , "discounts.retrieved", 200);
    }

    /**
     * @throws ApiException
     */
    public function store(StoreDiscountRequest $request)
    {
        $this->discountService->saveDiscount($request);

        return response()->api(null , "discounts.saved", 200);
    }

    /**
     * @throws ApiException
     */
    public function destroy(Discount $discount)
    {
        $this->discountService->deleteDiscount($discount);

        return response()->api(["discount" => $discount->id] , "discounts.deleted", 200);
    }

    /**
     * @throws ApiException
     */
    public function getProductsForDiscount($id)
    {

        $products = $this->discountService->getProductsForDiscount($id);

        return response()->api(["products" => $products] , "products.retrieved", 200);
    }

    /**
     * @throws ApiException
     */
    public function updateStatus($id)
    {
        $this->discountService->updateStatus($id);

        return response()->api(null , "discounts.status_updated", 200);
    }
}
