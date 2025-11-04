<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FuelType extends Model
{
    use HasFactory; // laravel will assume table name is fuel_types

    //protected $table = 'fuel_types';
    //protected $primaryKey = 'code'; // set primary key to 'code'
    //public $incrementing = false; // make incrementing false for string primary key
    //protected $keyType = 'string'; // set key type to string

    //const CREATED_AT = 'created_date';
    //const UPDATED_AT = null;

    public $timestamps = false; // disable timestamps

    protected $fillable = [
        "name"
    ];

    public function cars(): HasMany {
        return $this->hasMany(Car::class);
    }



}
