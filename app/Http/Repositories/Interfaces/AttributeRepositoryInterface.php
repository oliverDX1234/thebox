<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Attribute;

interface AttributeRepositoryInterface
{
    public function findById(int $id): Attribute;

    public function getAttributes();

    public function deleteAttribute(int $id);

}
