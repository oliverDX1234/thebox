<?php

namespace App\Models;

use Carbon\Carbon;
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
    use HasFactory, InteractsWithMedia;

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
        "seo_description"
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

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

    public function getMainImageAttribute(): array
    {
        if ($this->getFirstMedia("main_image")) {

            $image = [];

            $image["sm"] = $this->getFirstMedia("main_image")->getUrl("sm");
            $image["md"] = $this->getFirstMedia("main_image")->getUrl("md");
            $image["lg"] = $this->getFirstMedia("main_image")->getUrl();

            return $image;
        } else {

            return [
                "sm" => env("APP_URL") . "/images/package.png"
            ];
        }
    }

    public function getGalleryAttribute(): array
    {
        $images = $this->getMedia("gallery_images");
        $gallery = [];

        if($images->count()){

            foreach($images as $key => $image){

                $gallery[$key]["sm"] = $image->getUrl("sm");
                $gallery[$key]["md"] = $image->getUrl("md");
                $gallery[$key]["lg"] = $image->getUrl();
                $gallery[$key]["infos"] = [
                    "size" => $image->size,
                    "model_id" => $image->model_id,
                    "name" => $image->name,
                    "id" => $image->id,
                    "extension" => $image->mime_type
                ];
            }
            return $gallery;
        }else {
            return [];
        }
    }

    public function getPriceDiscountAttribute(): ?float
    {
        if(!$this->discount){
            return null;
        }

        if(!$this->discount->active){
            return null;
        }

        if($this->discount->start_date > Carbon::now()->toDateTimeString() || $this->discount->end_date < Carbon::now()->toDateTimeString()){
            return null;
        }

        if($this->discount->type === "fixed"){

            $price = max(0, $this->price - $this->discount->value);
        }else{
            $price = $this->price - ($this->price * ($this->discount->value/100));
        }

        return round($price);
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

    public function tempOrders()
    {
        $this->belongsToMany(TempOrder::class);
    }

    public function orders()
    {
        $this->belongsToMany(Order::class);
    }
}
