<?php

namespace App\Models;

use App\Http\Traits\HasMediaGallery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Package extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasMediaGallery;

    protected $table = "packages";

    protected $appends = ['main_image', "gallery", "price_discount"];

    protected $fillable = [
        "name",
        "unit_code",
        "weight",
        "vat",
        "price",
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

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class, "id", "discount_id");
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class)->withTimestamps();
    }
}
