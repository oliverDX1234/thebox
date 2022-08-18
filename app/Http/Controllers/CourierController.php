<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\CourierStoreRequest;
use App\Http\Services\CourierService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use stdClass;

class CourierController extends Controller
{
    protected $courierService;

    public function __construct(CourierService $courierService)
    {
        $this->courierService = $courierService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     * @throws ApiException
     */
    public function index(Request $request): Response
    {
        $couriers = $this->courierService->getCouriers($request);

        return response()->api(['couriers' => $couriers] , "couriers.retrieved", 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourierStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function store(CourierStoreRequest $request): Response
    {
        $this->courierService->saveCourier($request);

        return response()->api(null , "couriers.saved", 200);
    }

    /**
     * Display the specified resource.
     * @throws ApiException
     */
    public function show(int $id): Response
    {
        $courier = $this->courierService->getCourier($id);

        return response()->api(['courier' => $courier], "couriers.retrieved", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourierStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function update(CourierStoreRequest $request): Response
    {
        $this->courierService->updateCourier($request);

        return response()->api(null , "couriers.updated", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws ApiException
     */
    public function destroy(int $id): Response
    {
        $this->courierService->deleteCourier($id);

        return response()->api($id , "couriers.updated", 200);
    }
}
