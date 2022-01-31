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
    public function registerMediaCollections() : void
    {
        $this->addMediaCollection("products")->singleFile();
    }

    public function registerMediaConversions(Media $media = null) : void
    {

        $this->addMediaConversion('thumb')
            ->nonQueued()
            ->height(100);
    }


    public function getThumbAttribute() {
        if($this->getFirstMedia("products")){

            return $this->getFirstMedia("avatar")->getUrl('thumb');
        }else{
            return env("APP_URL")."/images/upload.png";
        }
    }

}
