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
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Package extends Model implements HasMedia, Searchable
{
    use HasFactory, InteractsWithMedia, HasMediaGallery;

    protected $table = "packages";

    protected $appends = ['main_image', "gallery", "price_discount", "price_no_vat"];

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
        "pre_made",
        "active"
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->price = $query->price ?? 0;

            if(!$query->name){
                $lastItem = Package::where("pre_made", 0)->latest()->first();

                if($lastItem){
                    $lastId = explode("-", $lastItem->name)[1];

                    $query->name = "Package-".(++$lastId);
                }else{
                    $query->name = "Package-"."1";
                }
            }
        });
    }

    public function getDimensionsAttribute($value)
    {

        return json_decode($value, true);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection("main_image")->singleFile();

        $this->addMediaCollection("gallery_images");
    }

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


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->name,
            "/admin/package/".$this->id
        );
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

    public function getPriceNoVatAttribute()
    {
        return round(($this->price_discount ?? $this->price) * (100 - $this->vat)/100);
    }

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class, "id", "discount_id");
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot(["quantity"]);
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class)->withTimestamps();
    }

    public function tempOrders()
    {
        return $this->belongsToMany(TempOrder::class, "temp_order_package")->withPivot(["quantity", "package_name", "package_price", "package_price_no_vat"]);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot(["quantity", "package_name", "package_price", "package_price_no_vat"]);
    }
}
