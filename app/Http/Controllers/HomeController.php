<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarFeatures;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\User;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(){

    $car = Car::find(1);

//    $carFeatures = new CarFeatures([
//        "abs" => true,
//        "air_conditioning" => false,
//        "power_windows" => false,
//        "power_door_locks" => false,
//        "remote_start" => false,
//        "gps_navigation" => false,
//        "heated_seats" => false,
//        "climate_control" => false,
//        "rear_parking_sensors" => false,
//        "leather_seats" => false,
//    ]);
//
//    $car->features()->save($carFeatures);


    // Create new image
//    $image = new CarImage([
//        "image_path" => "cars/car1_img3.jpg",
//        "position" => 3
//    ]);
//
//    $car->images()->save($image);
//
//    $car->images()->create([
//        "image_path" => "cars/car1_img3.jpg",
//        "position" => 4
//    ]);

//    $car->images()->saveMany([
//        new CarImage(["image_path" => "cars/car1_img6.jpg", "position" => 6]),
//        new CarImage(["image_path" => "cars/car1_img5.jpg", "position" => 5])
//    ]);
//
//    $car->images()->createMany([
//        ["image_path" => "cars/car1_img7.jpg", "position" => 7],
//        ["image_path" => "cars/car1_img8.jpg", "position" => 8],
//    ]);

//    $carType = CarType::where("name", "Hatchback")->first();
//
//    // Get cars using the relationship defined in CarType model
//    $cars = $carType->cars;
//
//    // Get all cars that belong to this car type
//    $cars = Car::whereBelongsTo($carType)->get();
//
//    // Associate car with car type
//    $car->car_type_id = $carType->id;
//    $car->save();
//
//    // Or using the associate method
//    $car->carType()->associate($carType);
//    $car->save();

//    dd($car->favouredUsers);

    $user = User::find(1);
//    dd($user->favoriteCars);

        $user->favoriteCars()->sync([2, 4]); // Sync favorites to only include cars with IDs 2 and 4. example: if user had cars 1,2,3 as favorites, after sync he will have only 2,4
        $user->favoriteCars()->syncWithPivotValues([1, 3], ['created_at' => now(), 'updated_at' => now()]); // Sync favorites with pivot values
        $user->favoriteCars()->attach([1, 2, 3]); // Attach cars with IDs 1 and 2 to user's favorites
        $user->favoriteCars()->detach([3]); // Detach car with ID 3 from user's favorites


        return view("home.index");
    }
}
