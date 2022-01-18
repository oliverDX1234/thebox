<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\FilterRepositoryInterface;
use App\Models\Filter;

class FilterRepository implements FilterRepositoryInterface
{

    public function findById($id): Filter
    {
        return Filter::findOrFail($id);
    }


    public function getFilters()
    {
        return Filter::all();
    }

    public function deleteFilter($id)
    {
        return Filter::findOrFail($id)->delete();
    }


}
