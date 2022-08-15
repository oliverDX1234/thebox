<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscountRequest;
use App\Http\Services\DiscountService;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    protected $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    /**
     * @throws \App\Exceptions\ApiException
     */
    public function index(Request $request)
    {
        $discounts = $this->discountService->getDiscounts($request);

        return response()->api(['discounts' => $discounts] , "discounts.retrieved", 200);
    }


    /**
     * @throws \App\Exceptions\ApiException
     */
    public function store(StoreDiscountRequest $request)
    {
        $this->discountService->saveDiscount($request);

        return response()->api(null , "discount.saved", 200);
    }


    /**
     * @throws \App\Exceptions\ApiException
     */
    public function update(StoreDiscountRequest $request, $id)
    {
        $this->discountService->updateDiscount($request);

        return response()->api(null , "discount.updated", 200);
    }

    /**
     * @throws \App\Exceptions\ApiException
     */
    public function destroy($id)
    {
        $this->discountService->deleteDiscount($id);

        return response()->api(["discount" => $id] , "discount.deleted", 200);
    }

    public function getProductsForDiscount($id)
    {

        $products = $this->discountService->getProductsForDiscount($id);

        return response()->api(["products" => $products] , "products.retrieved", 200);
    }

    public function updateStatus($id)
    {
        $this->discountService->updateStatus($id);

        return response()->api(null , "discounts.status_updated", 200);
    }
}
