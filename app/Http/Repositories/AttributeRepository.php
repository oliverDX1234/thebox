<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\AttributeRepositoryInterface;
use App\Models\Attribute;

class AttributeRepository implements AttributeRepositoryInterface
{

    public function findById($id): Attribute
    {
        return Attribute::findOrFail($id);
    }

    public function getAttributes()
    {
        return Attribute::all();
    }

    public function deleteAttribute($id)
    {
        return Attribute::findOrFail($id)->delete();
    }


}
