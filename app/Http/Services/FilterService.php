<?php

namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\FilterRepositoryInterface;
use App\Models\Filter;

class FilterService
{
    protected $filterRepository;

    public function __construct(
        FilterRepositoryInterface $filterRepository
    )
    {
        $this->filterRepository = $filterRepository;
    }
    public function getFilters()
    {
        try {
            return $this->filterRepository->getFilters()->load("attributes");
        } catch (Exception $e) {
            throw new ApiException("global.error", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function getFilter(int $id): Filter
    {
        try {
            return $this->filterRepository->findById($id);
        } catch (Exception $e) {
            throw new ApiException("filter.not_found", $e->getCode(), $e);
        }
    }

    /**
     * @throws ApiException
     */
    public function saveFilter($request)
    {

        $filter = Filter::make($request->except('active'));
        $filter->active = json_decode($request->active);

        $filter->save();

        try {
            $filter->save();
        } catch (Exception $e) {
            throw new ApiException("filter.save_failed", 500, null, $e);
        }
        return $filter;
    }

    /**
     * @throws ApiException
     */
    public function updateFilter($request)
    {
        try {
            $filter = $this->filterRepository->findById($request->id);
        } catch (Exception $e) {
            throw new ApiException("filter.not_found", $e->getCode(), $e);
        }

        $filter->update($request->except('active'));

        $filter->active = json_decode($request->active);

        try {
            $filter->save();
        } catch (Exception $e) {
            throw new ApiException("filter.update_failed", 500, null, $e);
        }

        return $filter->load("attributes");
    }

    /**
     * @throws ApiException
     */
    public function deleteFilter($id)
    {
        try {
            $this->filterRepository->deleteFilter($id);
        } catch (Exception $e) {
            throw new ApiException("filter.not_found", $e->getCode(), $e);
        }
    }

}

