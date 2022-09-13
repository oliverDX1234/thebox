<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Courier extends Model
{
    use HasFactory;

    protected $table = "couriers";

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $fillable = [
        "name",
        "email",
        "price",
        "active"
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
