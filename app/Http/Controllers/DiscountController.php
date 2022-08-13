<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $this->discountService->saveDiscount($request);

        return response()->api(null , "discount.saved", 200);
    }


    /**
     * @throws \App\Exceptions\ApiException
     */
    public function update(Request $request, $id)
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
}
