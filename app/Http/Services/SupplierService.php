<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Models\Supplier;
use Exception;

class SupplierService
{
    protected $supplierRepository;
    protected $imageService;

    public function __construct(
        SupplierRepositoryInterface $supplierRepository,
        ImageService            $imageService
    )
    {
        $this->supplierRepository = $supplierRepository;
        $this->imageService = $imageService;
    }

    public function getSuppliers()
    {
        try {
            return $this->supplierRepository->getSuppliers();
        } catch (Exception $e) {
            throw new ApiException("global.error", 404, null, $e);
        }
    }

    public function getSupplier(int $id): Supplier
    {
        try {
            return $this->supplierRepository->findById($id);
        } catch (Exception $e) {
            throw new ApiException("supplier.not_found", 404, null, $e);
        }
    }

    public function saveSupplier($request)
    {
        $supplier = Supplier::make($request->all());
        $supplier->save();

        if ($request->file('imageInput')) {
            $supplier->addMediaFromRequest("imageInput")
                ->toMediaCollection("avatar");
            $supplier->image = $supplier->getFirstMedia("avatar")->getUrl();
        }else{
            $supplier->image = env("APP_URL")."/images/upload.png";
        }

        try {
            $supplier->save();
        } catch (Exception $e) {
            throw new ApiException("supplier.save_failed", 500, null, $e);
        }
    }

    public function updateSupplier($request)
    {
        try {
            $supplier = $this->supplierRepository->findById($request->id);
        } catch (Exception $e) {
            throw new ApiException("supplier.not_found", 404, null, $e);
        }

        $supplier->fill($request->all());

        if ($request->file('imageInput')) {
            $supplier->addMediaFromRequest("imageInput")
                ->toMediaCollection("avatar");
            $supplier->image = $supplier->getFirstMedia("avatar")->getUrl();
        }

        try {
            $supplier->save();
        } catch (Exception $e) {
            throw new ApiException("supplier.update_failed", 500, null, $e);
        }
    }

    public function deleteSupplier($id)
    {
        try {
            $this->supplierRepository->deleteSupplier($id);
        } catch (Exception $e) {
            throw new ApiException("supplier.not_found", 404, null, $e);
        }
    }

}
