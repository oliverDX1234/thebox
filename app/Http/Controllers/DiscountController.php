<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
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
    public function update(StoreDiscountRequest $request)
    {
        $this->discountService->updateDiscount($request);

        return response()->api(null , "discounts.updated", 200);
    }

    /**
     * @throws ApiException
     */
    public function destroy($id)
    {
        $this->discountService->deleteDiscount($id);

        return response()->api(["discount" => $id] , "discounts.deleted", 200);
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
