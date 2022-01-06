<?php


namespace App\Http\Services;

use App\Http\Repositories\Interfaces\FillRepositoryInterface;

class FillService
{
    protected $fillRepository;

    public function __construct(FillRepositoryInterface $fillRepository)
    {
        $this->fillRepository = $fillRepository;
    }


}
