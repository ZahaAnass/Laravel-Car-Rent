<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, "index"])
->name("home");

Route::get("/car/search", [CarController::class, "search"])->name("car.search");
Route::get("/car/watchlist", [CarController::class, "watchlist"])->name("car.watchlist");
Route::get("/car/image/{car}", [CarController::class, "image"])->name("car.image");
Route::post('/car/{car}/image', [CarController::class, 'addImage'])->name('car.addImage');
Route::post('/car/{car}/images/positions', [CarController::class, 'updatePositions'])->name('car.updatePositions');
Route::post('/car/{car}/images/delete', [CarController::class, 'deleteImages'])->name('car.deleteImages');
Route::resource("car", CarController::class);
Route::post('/favourite/{carId}', [CarController::class, 'toggleFavourite'])->name('favourite.toggle');

Route::get("/signup", [SignupController::class, "index"])
->name("signup");

Route::get("/login", [LoginController::class, "index"])
->name("login");

Route::post("/login", [LoginController::class, "login"])
->name("login.post");

Route::post("/signup", [SignupController::class, "signup"])
->name("signup.post");

Route::get("/logout", [LoginController::class, "logout"])->name("logout");

Route::get("/password-reset", [LoginController::class, "passwordReset"])
    ->name('password-reset');
