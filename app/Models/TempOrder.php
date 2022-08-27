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
        $this->belongsToMany(Package::class);
    }
}
