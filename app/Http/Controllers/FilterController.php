<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\FilterStoreRequest;
use App\Http\Services\FilterService;
use Illuminate\Http\Response;

class FilterController extends Controller
{
    protected $filterService;

    public function __construct(FilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws ApiException
     */
    public function index(): Response
    {
        $filters = $this->filterService->getFilters();

        return response()->api(['filters' => $filters] , "filters.retrieved", 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param FilterStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function store(FilterStoreRequest $request): Response
    {
        $this->filterService->saveFilter($request);

        return response()->api(null , "filter.saved", 200);
    }

    /**
     * Display the specified resource.
     * @throws ApiException
     */
    public function show(int $id): Response
    {
        $filter = $this->filterService->getFilter($id);

        return response()->api(['filter' => $filter], "filter.retrieved", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FilterStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function update(FilterStoreRequest $request): Response
    {
        $filter = $this->filterService->updateFilter($request);

        return response()->api(['filter' => $filter] , "filter.updated", 200);
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
        $this->filterService->deleteFilter($id);

        return response()->api(["filter" => $id] , "filter.deleted", 200);
    }
}
