<?php


namespace App\Http\Services;

use App\Exceptions\ApiException;
use App\Http\Repositories\Interfaces\FillRepositoryInterface;

class FillService
{
    protected $fillRepository;

    public function __construct(FillRepositoryInterface $fillRepository)
    {
        $this->fillRepository = $fillRepository;
    }

    public function getCities()
    {
        try {
            return $this->fillRepository->getCities();
        } catch (\Exception $e) {
            throw new ApiException("generic.problem", 404, null, $e);
        }

    }
}
