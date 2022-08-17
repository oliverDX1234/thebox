<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Attribute
 *
 * @property int $id
 * @property string $attribute
 * @property string $name
 * @property int $filter_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Filter $filter
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereFilterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        "attribute",
        "filter_id",
        'name'
    ];

    public function filter(): BelongsTo
    {

        return $this->belongsTo(Filter::Class);
    }

    public function product(): BelongsTo
    {

        return $this->belongsTo(Product::Class);
    }


}
