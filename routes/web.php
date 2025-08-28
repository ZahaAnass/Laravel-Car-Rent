<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignupController;

Route::get("/", [HomeController::class, "index"])
->name("home");

Route::get("/signup", [SignupController::class, "create"])
->name("signup");

Route::get("/login", [LoginController::class, "create"])
->name("login");
