<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\CourierRepositoryInterface;
use App\Models\Courier;
use Exception;

class CourierService
{
    protected $courierRepository;

    public function __construct(
        CourierRepositoryInterface $courierRepository
    )
    {
        $this->courierRepository = $courierRepository;
    }

    /**
     * @throws ApiException
     */
    public function getCouriers($request)
    {
        try {
            return $this->courierRepository->getCouriers($request);
        } catch (Exception $e) {
            throw new ApiException("global.error", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function getCourier(int $id): Courier
    {
        try {
            return $this->courierRepository->findById($id);
        } catch (Exception $e) {
            throw new ApiException("couriers.not_found", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function saveCourier($request)
    {
        try {
            $courier = Courier::make($request->except('active'));
            $courier->active = json_decode($request->active);

            $courier->save();
        } catch (Exception $e) {
            throw new ApiException("couriers.save_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function updateCourier($request)
    {
        try {
            $courier = $this->courierRepository->findById($request->id);
        } catch (Exception $e) {
            throw new ApiException("couriers.not_found", $e->getCode(), $e);
        }

        try {
            $courier->update($request->all());

            $courier->save();
        } catch (Exception $e) {
            dd($e);
            throw new ApiException("couriers.update_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function deleteCourier($id)
    {
        try {
            $this->courierRepository->deleteCourier($id);
        } catch (Exception $e) {

            throw new ApiException("couriers.not_found",  $e->getCode(), null, $e);
        }
    }

}
