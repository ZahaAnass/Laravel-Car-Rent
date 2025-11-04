<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Model extends EloquentModel
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'maker_id',
    ];

    public function maker(): HasMany {
        return $this->hasMany(Maker::class);
    }

    public function cars(): HasMany {
        return $this->hasMany(Car::class);
    }

}
