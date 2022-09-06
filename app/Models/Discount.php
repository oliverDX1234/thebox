<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Discount
 *
 * @property int $id
 * @property int $value
 * @property string $type
 * @property string $start_date
 * @property string $end_date
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $is_valid
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\DiscountFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereValue($value)
 * @mixin \Eloquent
 */
class Discount extends Model
{
    use HasFactory;

    protected $table = "discounts";

    protected $appends = ["is_valid"];

    protected $fillable = [
        "value",
        "name",
        "type",
        "start_date",
        "end_date",
        "active"
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, "discount_id", "id");
    }

    public function getIsValidAttribute(): bool
    {
        if ($this->start_date < Carbon::now()->toDateTimeString() && $this->end_date > Carbon::now()->toDateTimeString()) {
            return true;
        }

        return false;
    }
}
