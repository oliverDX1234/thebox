<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\PackageStoreRequest;
use App\Http\Requests\UpdatePackageQuantityRequest;
use App\Http\Services\PackageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PackageController extends Controller
{
    protected $packageService;

    public function __construct(PackageService $packageService)
    {
        $this->packageService = $packageService;
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

        $packages = $this->packageService->getPackages($request);

        return response()->api(['packages' => $packages] , "packages.retrieved", 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PackageStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function store(PackageStoreRequest $request): Response
    {
        $this->packageService->savePackage($request);

        return response()->api(null , "packages.saved", 200);
    }

    /**
     * Display the specified resource.
     * @throws ApiException
     */
    public function show(int $id): Response
    {
        $package = $this->packageService->getPackage($id);

        return response()->api(['package' => $package], "packages.retrieved", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PackageStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function update(PackageStoreRequest $request): Response
    {
        $this->packageService->updatePackage($request);

        return response()->api(null , "packages.updated", 200);
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
        $this->packageService->deletePackage($id);

        return response()->api(["package" => $id] , "packages.deleted", 200);
    }

    /**
     * @throws ApiException
     */
    public function removePackageDiscount($id)
    {
        $this->packageService->removePackageDiscount($id);

        return response()->api(null , "packages.discount_successfully_removed", 200);
    }

    /**
     * @throws ApiException
     */
    public function updatePackageQuantity(UpdatePackageQuantityRequest $request)
    {
        $this->packageService->updatePackageQuantity($request);

        return response()->api(null , "packages.updated_package_quantity", 200);
    }
}
