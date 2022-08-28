<?php

namespace App\Http\Traits;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait ImageTrait
{
    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     */
    public function uploadMainImage($mainImage)
    {
        $this->addMedia($mainImage)
            ->toMediaCollection("main_image");
    }

    public function uploadGalleryImages($galleryImages, $oldIds = null)
    {
        if($oldIds){
            //Delete gallery images
            $media = Media::where("collection_name", "gallery_images")->where("model_type", get_class($this))->where("model_id", $this->id)->get();

            foreach ($media as $i) {
                if(!in_array($i->id, json_decode($oldIds))){
                    $this->deleteMedia($i->id);
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
}
