<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    public function getUserShippingDetailsAttribute($value)
    {

        return json_decode($value);
    }

    public function packages()
    {

        return $this->belongsToMany(Package::class)->withPivot(["quantity", "package_name", "package_price", "package_price_no_vat"]);
    }
}
