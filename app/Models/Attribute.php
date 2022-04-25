<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        "attribute",
        "filter_id",
        'name'
    ];

    public function filter()
    {

        return $this->belongsTo(Filter::Class);
    }

    public function product()
    {

        return $this->belongsTo(Product::Class);
    }


}
