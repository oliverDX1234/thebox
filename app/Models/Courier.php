<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Courier extends Model implements Searchable
{
    use HasFactory;

    protected $table = "couriers";

    protected $casts = [
        'active' => 'boolean'
    ];

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->name,
            "/admin/courier/".$this->id
        );
    }

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
