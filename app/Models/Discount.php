<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = "discounts";

    protected $appends = ["is_valid"];

    protected $fillable = [
      "value",
      "type",
      "start_date",
      "end_date",
      "active"
    ];

    public function products()
    {
        $this->hasMany(Product::class, "discount_id", "id");
    }

    public function getIsValidAttribute()
    {
        if($this->start_date < Carbon::now()->toDateTimeString() && $this->end_date > Carbon::now()->toDateTimeString()){
            return true;
        }

        return false;
    }
}
