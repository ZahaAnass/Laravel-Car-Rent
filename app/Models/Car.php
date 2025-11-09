<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'maker_id',
        'model_id',
        'year',
        'price',
        'vin',
        'mileage',
        'car_type_id',
        'fuel_type_id',
        'city_id',
        'user_id',
        'address',
        'phone',
        'description',
        'published_at'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function carType(): BelongsTo {
        return $this->belongsTo(CarType::class);
    }

    public function fuelType(): BelongsTo {
        return $this->belongsTo(FuelType::class);
    }

    public function maker(): BelongsTo {
        return $this->belongsTo(Maker::class);
    }

    public function model(): BelongsTo {
        return $this->belongsTo(\App\Models\Model::class);
    }

    public function owner(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function city(): BelongsTo {
        return $this->belongsTo(City::class);
    }

    public function features() {
        return $this->hasOne(CarFeatures::class);
    }

    public function primaryImage() {
        return $this->hasOne(CarImage::class)->oldestOfMany("position");
    }

    public function images() {
        return $this->hasMany(CarImage::class);
    }

    public function favouredUsers(): BelongsToMany {
        return $this->belongsToMany(User::class, 'favorites_cars', 'car_id', 'user_id');
    }

    public function getCreateDate(): string {
        return (new Carbon($this->created_at))->format("Y-m-d");
    }

}
