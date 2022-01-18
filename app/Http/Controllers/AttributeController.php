<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\AttributeStoreRequest;
use App\Http\Services\AttributeService;
use Illuminate\Http\Response;

class AttributeController extends Controller
{
    protected $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws ApiException
     */
    public function index(): Response
    {
        $attributes = $this->attributeService->getAttributes();

        return response()->api(['attributes' => $attributes] , "attributes.retrieved", 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param AttributeStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function store(AttributeStoreRequest $request): Response
    {
        $this->attributeService->saveAttribute($request);

        return response()->api(null , "attribute.saved", 200);
    }

    /**
     * Display the specified resource.
     * @throws ApiException
     */
    public function show(int $id): Response
    {
        $attribute = $this->attributeService->getAttribute($id);

        return response()->api(['attribute' => $attribute], "attribute.retrieved", 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AttributeStoreRequest $request
     * @return Response
     * @throws ApiException
     */
    public function update(AttributeStoreRequest $request): Response
    {
        $attribute = $this->attributeService->updateAttribute($request);

        return response()->api(['attribute' => $attribute] , "attribute.updated", 200);
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
        $this->attributeService->deleteAttribute($id);

        return response()->api(["attribute" => $id] , "attribute.deleted", 200);
    }
}
