<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;



    protected $table = "categories";


//    protected function getParentAttribute()
//    {
//        if(!$this->attributes['parent']){
//            return 0;
//        }
//        return Category::select("id", "name")->where("id", $this->attributes['parent'])->first();
//    }
}
