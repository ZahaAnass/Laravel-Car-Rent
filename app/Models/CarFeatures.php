<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarFeatures extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "car_id",
        "abs",
        "air_conditioning",
        "power_windows",
        "power_door_locks",
        "remote_start",
        "gps_navigation",
        "heated_seats",
        "climate_control",
        "rear_parking_sensors",
        "leather_seats",
        "created_at",
        "updated_at"
    ];
}
