<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\CarController;

Route::get("/", [HomeController::class, "index"])
->name("home");

Route::get("/car/search", [CarController::class, "search"])->name("car.search");
Route::get("/car/watchlist", [CarController::class, "watchlist"])->name("car.watchlist");
Route::resource("car", CarController::class);

Route::get("/signup", [SignupController::class, "create"])
->name("signup");

Route::get("/login", [LoginController::class, "create"])
->name("login");
