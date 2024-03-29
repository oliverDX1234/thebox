<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\AttributeRepositoryInterface;
use App\Models\Attribute;
use Exception;

class AttributeService
{
    protected $attributeRepository;

    public function __construct(
        AttributeRepositoryInterface $attributeRepository
    )
    {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @throws ApiException
     */
    public function getAttributes()
    {
        try {
            return $this->attributeRepository->getAttributes();
        } catch (Exception $e) {
            throw new ApiException("global.error", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function getAttribute(int $id): Attribute
    {
        try {
            return $this->attributeRepository->findById($id);
        } catch (Exception $e) {
            throw new ApiException("attribute.not_found", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function saveAttribute($request)
    {
        try {
            $attribute = Attribute::make($request->except('active'));

            $attribute->save();
        } catch (Exception $e) {
            throw new ApiException("attribute.save_failed", 500, null, $e);
        }


        return $attribute;
    }

    /**
     * @throws ApiException
     */
    public function updateAttribute($request): Attribute
    {
        try {
            $attribute = $this->attributeRepository->findById($request->id);

            $attribute->update($request->except('active'));

            return $attribute;
        } catch (Exception $e) {
            throw new ApiException("attribute.update_failed", 500, null, $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function deleteAttribute($id)
    {
        try {
            $this->attributeRepository->deleteAttribute($id);
        } catch (Exception $e) {
            throw new ApiException("attribute.not_found", $e->getCode(), $e);
        }
    }

}

