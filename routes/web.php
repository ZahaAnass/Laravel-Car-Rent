<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCarController;
use App\Http\Controllers\AdminUserController;

/*
|--------------------------------------------------------------------------
| 1. Public Routes (Accessible by everyone)
|--------------------------------------------------------------------------
*/
Route::get("/", [HomeController::class, "index"])->name("home");

// Google Auth (Must be public to handle the redirect/callback)
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');


/*
|--------------------------------------------------------------------------
| 2. Guest Routes (Only for people NOT logged in)
|--------------------------------------------------------------------------
| Middleware: 'guest'
| If a logged-in user tries to go here, they are redirected to Home.
*/
Route::middleware(['guest'])->group(function () {

    // Auth Pages
    Route::get("/signup", [SignupController::class, "index"])->name("signup");
    Route::post("/signup", [SignupController::class, "signup"])->name("signup.post");
    Route::get("/login", [LoginController::class, "index"])->name("login");
    Route::post("/login", [LoginController::class, "login"])->name("login.post");

    // Password Reset
    Route::get("/password-reset", [ForgotPasswordController::class, "passwordReset"])->name('password-reset');
    Route::post("/password-reset", [ForgotPasswordController::class, "sendResetLinkEmail"])->name('password-reset.post');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});


/*
|--------------------------------------------------------------------------
| 3. Protected Routes (Only for LOGGED IN users)
|--------------------------------------------------------------------------
| Middleware: 'auth'
| If a guest tries to go here, they are redirected to Login.
*/
Route::middleware(['auth'])->group(function () {

    // Logout
    Route::get("/logout", [LoginController::class, "logout"])->name("logout");

    // User Profile Management
    Route::get("/profile", [ProfileController::class, "index"])->name("profile");
    Route::patch("/profile/update", [ProfileController::class, "updateProfile"])->name("profile.update");
    Route::patch("/profile/update-password", [ProfileController::class, "updatePassword"])->name("profile.updatePassword");
    Route::delete("/profile/delete-account", [ProfileController::class, "deleteAccount"])->name("profile.deleteAccount");

    // Car Management
    Route::get("/car/search", [CarController::class, "search"])->name("car.search");
    Route::get("/car/watchlist", [CarController::class, "watchlist"])->name("car.watchlist");

    // Car Images
    Route::get("/car/image/{car}", [CarController::class, "image"])->name("car.image");
    Route::post('/car/{car}/image', [CarController::class, 'addImage'])->name('car.addImage');
    Route::post('/car/{car}/images/positions', [CarController::class, 'updatePositions'])->name('car.updatePositions');
    Route::post('/car/{car}/images/delete', [CarController::class, 'deleteImages'])->name('car.deleteImages');

    // Favorites
    Route::post('/favourite/{carId}', [CarController::class, 'toggleFavourite'])->name('favourite.toggle');

    // The Resource (CRUD)
    // Since this is inside the 'auth' group, you must be logged in to see/create/edit cars.
    // If you want everyone to SEE cars but only users to CREATE them, move this outside (see note below).
    Route::resource("car", CarController::class);
});

Route::prefix("admin")->name("admin.")->middleware(["auth", "admin"])->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Car Images
    Route::get("/car/image/{car}", [AdminCarController::class, "image"])->name("cars.image");
    Route::post('/car/{car}/image', [AdminCarController::class, 'addImage'])->name('cars.addImage');
    Route::post('/car/{car}/images/positions', [AdminCarController::class, 'updatePositions'])->name('cars.updatePositions');
    Route::post('/car/{car}/images/delete', [AdminCarController::class, 'deleteImages'])->name('cars.deleteImages');

    Route::resource('cars', AdminCarController::class); // manage cars

    Route::patch("users/update-password/{user}", [AdminUserController::class, "updatePassword"])->name("users.updatePassword");
    Route::resource('users', AdminUserController::class); // manage users
    Route::get("/profile", [ProfileAdminController::class, "index"])->name("profile");
    Route::patch("/profile/update", [ProfileAdminController::class, "updateProfile"])->name("profile.update");
    Route::patch("/profile/update-password", [ProfileAdminController::class, "updatePassword"])->name("profile.updatePassword");
    Route::delete("/profile/delete-account", [ProfileAdminController::class, "deleteAccount"])->name("profile.deleteAccount");
});

