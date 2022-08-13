<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

    protected $table = "product_price";

    protected $fillable = [
        "product_id",
        "price",
        "supplier_price",
        "discounted_price",
        "discount_valid_until"
    ];

    public function product()
    {
        $this->belongsTo(Product::class, "id", "product_id");
    }
}
