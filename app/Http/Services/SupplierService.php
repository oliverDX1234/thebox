<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Models\Supplier;
use Exception;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(
        SupplierRepositoryInterface $supplierRepository
    )
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * @throws ApiException
     */
    public function getSuppliers()
    {
        try {
            return $this->supplierRepository->getSuppliers();
        } catch (Exception $e) {
            throw new ApiException("global.error", 404, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function getSupplier(int $id): Supplier
    {
        try {
            return $this->supplierRepository->findById($id);
        } catch (Exception $e) {
            throw new ApiException("supplier.not_found", 404, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function saveSupplier($request)
    {

        $supplier = Supplier::make($request->except('active'));
        $supplier->active = json_decode($request->active);

        $supplier->save();

        try {
            $supplier->save();
        } catch (Exception $e) {
            throw new ApiException("supplier.save_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function updateSupplier($request)
    {
        try {
            $supplier = $this->supplierRepository->findById($request->id);
        } catch (Exception $e) {
            throw new ApiException("supplier.not_found", 404, null, $e);
        }

        $supplier->update($request->except('active'));

        $supplier->active = json_decode($request->active);

        try {
            $supplier->save();
        } catch (Exception $e) {
            throw new ApiException("supplier.update_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function deleteSupplier($id)
    {
        try {
            $this->supplierRepository->deleteSupplier($id);
        } catch (Exception $e) {
            throw new ApiException("supplier.not_found", 404, null, $e);
        }
    }

}
