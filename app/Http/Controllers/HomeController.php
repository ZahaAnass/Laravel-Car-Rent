<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Maker;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(){

        $cars = Car::where("published_at", "<=", now())
            ->with([
                "city",
                "maker",
                "model",
                "carType",
                "fuelType",
                "primaryImage"
            ])
            ->withExists([
                "favouredUsers as is_favourite" => function ($query) {
                    $query->where("user_id", auth()->id());
                }
            ])
            ->orderBy("published_at", "desc")
            ->limit(30)
            ->get();

        return view("home.index", ["cars" => $cars]);
    }
}
