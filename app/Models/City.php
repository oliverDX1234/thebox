<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "cities";

    protected $visible = ["id", "city_name_en", "zip_code"];

    use HasFactory;
}
