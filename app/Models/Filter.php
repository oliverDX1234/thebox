<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Filter
 *
 * @property int $id
 * @property string $filter
 * @property string $name
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Attribute[] $attributes
 * @property-read int|null $attributes_count
 * @property-read Collection|Category[] $category
 * @property-read int|null $category_count
 * @method static \Illuminate\Database\Eloquent\Builder|Filter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Filter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Filter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Filter whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filter whereFilter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Filter extends Model
{
    use HasFactory;
    protected $casts = [
        'active' => 'boolean'
    ];

    protected $fillable = [
        "filter",
        "name"
    ];


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function attributes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Attribute::Class);
    }
}
