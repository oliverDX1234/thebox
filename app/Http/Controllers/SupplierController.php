<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\SupplierStoreRequest;
use App\Http\Services\SupplierService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws ApiException
     */
    public function index(Request $request): Response
    {
        $suppliers = $this->supplierService->getSuppliers($request);

        return response()->api(['suppliers' => $suppliers] , "suppliers.retrieved", 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param SupplierStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function store(SupplierStoreRequest $request): Response
    {
        $this->supplierService->saveSupplier($request);

        return response()->api(null , "supplier.saved", 200);
    }

    /**
     * Display the specified resource.
     * @throws ApiException
     */
    public function show(int $id): Response
    {
        $supplier = $this->supplierService->getSupplier($id);

        return response()->api(['supplier' => $supplier], "supplier.retrieved", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SupplierStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function update(SupplierStoreRequest $request): Response
    {
        $this->supplierService->updateSupplier($request);

        return response()->api(null , "supplier.updated", 200);
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

    }
}
