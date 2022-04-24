<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $appends = ['thumb'];

    protected $fillable = [
        "name",
        "unit_code",
        "weight",
        "vat",
        "price",
        "supplier_price",
        "short_description",
        "description",
        "seo_title",
        "seo_keywords",
        "seo_description"
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function getDimensionsAttribute($value)
    {

        return json_decode($value, true);
    }

    protected function getSupplierIdAttribute($value)
    {
        return Supplier::select(["id", "name", "email"])->find($value);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection("main_image")->singleFile();

        $this->addMediaCollection("gallery_images");
    }

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


    public function getThumbAttribute()
    {
        if ($this->getFirstMedia("products")) {

            return $this->getFirstMedia("avatar")->getUrl('thumb');
        } else {
            return env("APP_URL") . "/images/img-1.png";
        }
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
}
