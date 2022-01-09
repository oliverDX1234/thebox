<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;
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
     */
    public function index()
    {
        $suppliers = $this->supplierService->getSuppliers();

        return response()->api(['suppliers' => $suppliers] , "suppliers.retrieved", 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  SupplierStoreRequest  $request
     * @return Response
     */
    public function store(SupplierStoreRequest $request): Response
    {
        $this->supplierService->saveSupplier($request);

        return response()->api(null , "supplier.saved", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $supplier = $this->supplierService->getSupplier($id);

        return response()->api(['supplier' => $supplier], "supplier.retrieved", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SupplierUpdateRequest $request
     * @param int $id
     * @return Response
     * @throws \App\Exceptions\ApiException
     */
    public function update(Request $request): Response
    {
        $this->supplierService->updateSupplier($request);

        return response()->api(null , "supplier.updated", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->supplierService->deleteSupplier($id);

        return response()->api(["supplier" => $id] , "supplier.deleted", 200);
    }
}
