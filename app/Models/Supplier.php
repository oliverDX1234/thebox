<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'active',
        'city',
        'phone',
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected function getCityAttribute()
    {
        return City::find($this->attributes['city']);
    }

    public function products()
    {
        return $this->hasMany(Product::class, "id", "supplier_id");
    }
}
