<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarType extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "name"
    ];

    public function cars(): HasMany {
        return $this->hasMany(Car::class);
    }

}
