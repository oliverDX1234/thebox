<?php

namespace App\Models;

use App\Http\Traits\HasMediaGallery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $supplier_id
 * @property string|null $short_description
 * @property string $unit_code
 * @property int $vat
 * @property int $seen_times
 * @property int $weight
 * @property string $dimensions
 * @property string|null $description
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property int $price
 * @property int $price_supplier
 * @property int|null $discount_id
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Collection|Attribute[] $attributes
 * @property-read int|null $attributes_count
 * @property-read Collection|Category[] $categories
 * @property-read int|null $categories_count
 * @property-read Discount|null $discount
 * @property-read mixed $gallery
 * @property-read mixed $main_image
 * @property-read mixed $price_discount
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read Supplier|null $supplier
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDimensions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePriceSupplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSeenTimes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUnitCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereWeight($value)
 * @mixin \Eloquent
 */
class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasMediaGallery;

    protected $appends = ['main_image', "gallery", "price_discount"];

    protected $fillable = [
        "name",
        "unit_code",
        "weight",
        "vat",
        "price",
        "price_supplier",
        "short_description",
        "description",
        "seo_title",
        "seo_keywords",
        "seo_description",
        "active"
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion("sm")
            ->nonQueued()
            ->width(100)
            ->height(100);

        $this->addMediaConversion("md")
            ->nonQueued()
            ->width(300)
            ->height(300);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection("main_image")->singleFile();

        $this->addMediaCollection("gallery_images");
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function supplier(): HasOne
    {

        return $this->hasOne(Supplier::class, "id", "supplier_id");
    }

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class)->withTimestamps();
    }

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class, "id", "discount_id");
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class)->withTimestamps();
    }
}
