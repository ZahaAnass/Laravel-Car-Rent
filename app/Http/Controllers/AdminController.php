<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $carsCount = Car::count();
        $usersCount = User::count();

        return view('admin.dashboard', [
            'carsCount' => $carsCount,
            'usersCount' => $usersCount,
        ]);
    }

    public function setting()
    {
        return view("admin.profile");
    }

}
