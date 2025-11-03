<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarFeatures;
use App\Models\FuelType;
use App\Models\Maker;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(){

    $car = Car::find(1);

    $car = Car::find(2);

    $carFeatures = new CarFeatures([
        "abs" => true,
        "air_conditioning" => false,
        "power_windows" => false,
        "power_door_locks" => false,
        "remote_start" => false,
        "gps_navigation" => false,
        "heated_seats" => false,
        "climate_control" => false,
        "rear_parking_sensors" => false,
        "leather_seats" => false,
    ]);

    $car->features()->save($carFeatures);

        return view("home.index");
    }
}
