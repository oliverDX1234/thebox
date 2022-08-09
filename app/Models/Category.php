<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
//    protected $with = ['filters'];

    protected $fillable = [
        'name',
        'description',
        'url',
        'seo_keywords',
        'parent',
        'active',
        'seo_description'
    ];

    protected $hidden = ['category_products'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function filters()
    {

        return $this->belongsToMany(Filter::class);
    }

    public function products()
    {

        return $this->hasMany(Product::class);
    }
}
