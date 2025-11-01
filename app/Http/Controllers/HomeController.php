<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(){
        // Select All Cars
        $cars = Car::get();

        // Select published Cars
        $cars = Car::where("published_at", "!=", null)->get();
        $cars = Car::whereNotNull('published_at')->get();

        // Select the first car
        $car = Car::whereNotNull("published_at")->first();

        // Select a car by its ID
        $car = Car::find(3);

        // Select cars by order
            // $cars = Car::whereNotNull("published_at")
            //     ->where("user_id", 1)
            //     ->orderBy("published_at", "desc")
            //     ->limit(3)
            //     ->get();
            //
            // dump($cars);

//        $car = new Car();
//        $car->maker_id = 1;
//        $car->model_id = 1;
//        $car->year = 1900;
//        $car->price = 123;
//        $car->vin = 123;
//        $car->mileage = 123;
//        $car->car_type_id = 1;
//        $car->fuel_type_id = 1;
//        $car->user_id = 1;
//        $car->city_id = 1;
//        $car->address = "Lorem Ipsum";
//        $car->phone = "123";
//        $car->description = "description";
//        $car->published_at = now();
//        $car->save();

        $carData = [
            "maker_id" => 1,
            "model_id" => 1,
            "year" => 1900,
            "price" => 123,
            "vin" => 123,
            "mileage" => 123,
            "car_type_id" => 1,
            "fuel_type_id" => 1,
            "user_id" => 1,
            "city_id" => 1,
            "address" => "Lorem Ipsum",
            "phone" => "123",
            "description" => "description",
            "published_at" => now(),
        ];

        // Approach 1
//        $car = Car::create($carData);

        // Approach 2
        // $car = new Car();
        // $car->fill($carData);
        // $car->save();

        // Approach 3
        // $car = new Car($carData);
        // $car->save();

        return view("home.index");
    }
}
