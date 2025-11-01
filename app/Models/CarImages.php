<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarImages extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "position",
        "image_path"
    ];
}
