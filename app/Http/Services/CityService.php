<?php


namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\CityRepositoryInterface;

class CityService
{
    protected $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function getCities()
    {
        try {
            return $this->cityRepository->getCities();
        } catch (\Exception $e) {
            throw new ApiException("generic.problem", $e->getCode(), $e);
        }

    }
}
