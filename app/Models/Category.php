<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $description
 * @property int|null $parent
 * @property string $seo_keywords
 * @property string $seo_description
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Filter[] $filters
 * @property-read int|null $filters_count
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\CategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUrl($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        'name',
        'description',
        'url',
        'seo_keywords',
        'parent',
        'active',
        'seo_description'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function filters(): BelongsToMany
    {

        return $this->belongsToMany(Filter::class)->withTimestamps();
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
