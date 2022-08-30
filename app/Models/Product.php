<?php

namespace App\Models;

use App\Http\Traits\HasMediaGallery;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasMediaGallery;

    protected $appends = ['main_image', "gallery", "price_discount", "price_no_vat"];

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

    public function getPriceNoVatAttribute()
    {
        return round(($this->price_discount ?? $this->price) * (100 - $this->vat)/100);
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

    public function getPriceDiscountAttribute(): ?float
    {
        if (!$this->discount) {
            return null;
        }

        if (!$this->discount->active) {
            return null;
        }

        if ($this->discount->start_date > Carbon::now()->toDateTimeString() || $this->discount->end_date < Carbon::now()->toDateTimeString()) {
            return null;
        }

        if ($this->discount->type === "fixed") {
            $price = max(0, $this->price - $this->discount->value);
        } else {
            $price = $this->price - ($this->price * ($this->discount->value / 100));
        }

        return round($price);
    }
}
