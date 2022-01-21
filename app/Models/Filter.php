<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;
    protected $casts = [
        'active' => 'boolean'
    ];

    protected $fillable = [
        "filter",
        "name"
    ];


    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::Class);
    }
}
