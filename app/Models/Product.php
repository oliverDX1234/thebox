<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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


    public function getMainImageAttribute()
    {
        if ($this->getFirstMedia("main_image")) {

            $image = [];

            $image["sm"] = $this->getFirstMedia("main_image")->getUrl("sm");
            $image["md"] = $this->getFirstMedia("main_image")->getUrl("md");
            $image["lg"] = $this->getFirstMedia("main_image")->getUrl();

            return $image;
        } else {

            return [
                "sm" => env("APP_URL") . "/images/img-1.png"
            ];
        }
    }

    public function getGalleryAttribute()
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

    public function getPriceDiscountAttribute()
    {
        if(!$this->discount){
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

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function supplier()
    {

        return $this->hasOne(Supplier::class, "id", "supplier_id");
    }

    public function discount()
    {
        return $this->hasOne(Discount::class, "id", "discount_id");
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
}
