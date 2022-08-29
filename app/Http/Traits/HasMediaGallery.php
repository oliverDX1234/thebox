<?php

namespace App\Http\Traits;

use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait HasMediaGallery
{
    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function uploadMainImage($mainImage): void
    {
        $this->addMedia($mainImage)
            ->toMediaCollection("main_image");
    }

    public function uploadGalleryImages($galleryImages, $oldIds = null): void
    {
        if ($oldIds) {
            $oldIds = json_decode($oldIds);

            //Delete gallery images
            $modelMedia = Media::where("collection_name", "gallery_images")
                ->where("model_type", get_class($this))
                ->where("model_id", $this->id)
                ->get();

            foreach ($modelMedia as $image) {
                if (!in_array($image->id, $oldIds)) {
                    $this->deleteMedia($image->id);
                }
            }
        }

        //Add gallery images
        foreach ($galleryImages ?? [] as $galleryImage) {
            $this
                ->addMedia($galleryImage)
                ->toMediaCollection("gallery_images");
        }
    }

    public function getDimensionsAttribute($value)
    {
        return json_decode($value, true);
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

        if ($images->count()) {

            foreach ($images as $key => $image) {

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
        } else {
            return [];
        }
    }

}
