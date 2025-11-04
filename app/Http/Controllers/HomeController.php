<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(){

//        $makers = Maker::factory()->count(10)->make();
//        $makers = Maker::factory()->count(10)->create();
//        dd($makers);

//        User::factory()->count(10)
//            ->create([
//                "name" => "Anass"
//            ]); // create 10 user with name Anass

//        User::factory()
//            ->count(10)
//            ->sequence(
//                ["name" => "Anass"],
//                ["name" => "Mohamed"],
//                ["name" => "Youssef"],
//            )->sequence(fn (Sequence $sequence) => [
//                'name' => 'Name' . ($sequence->index + 1)
//            ])->unverified() // make email_verified_at null
//            ->create(); // create 10 user with name Anass, Mohamed, Youssef in sequence

//        User::factory()
//            ->afterMaking(function (User $user) {
//                dump($user);
//            })
//            ->create();

        // Relation: One to Many
//        Maker::factory()
//            ->count(5)
//            ->hasModels(3) // each maker will have 3 models
//            ->create();

        // Relation: Many to One
        Model::factory()
            ->count(5)
            ->forMaker(["name" => "test"]) // each model will belong to a maker
            ->create();

        return view("home.index");
    }
}
