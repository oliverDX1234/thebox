<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempOrder extends Model
{
    use HasFactory;

    protected $table = "temp_orders";

    public function packages()
    {

        return $this->belongsToMany(Package::class, "temp_order_package")->withPivot(["quantity", "package_name", "package_price", "package_price_no_vat"]);
    }
}
