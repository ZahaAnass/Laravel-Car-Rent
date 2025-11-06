<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarImage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "position",
        "image_path"
    ];

    public function car(): BelongsTo {
        return $this->belongsTo(Car::class);
    }
}
