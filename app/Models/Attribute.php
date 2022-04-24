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

        $this->belongsTo(Filter::Class);
    }

    public function product()
    {

        $this->belongsTo(Product::Class);
    }


}
