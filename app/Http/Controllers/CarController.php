<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = User::find(1)
            ->cars()
            ->with(["maker", "model", "primaryImage"])
            ->orderBy("created_at", "desc")
            ->paginate(15);

        return view("car.index", ["cars" => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makers = Maker::distinct()->orderBy('name')->get();
        $models = Model::distinct()->orderBy('name')->get();
        $states = State::distinct()->orderBy('name')->get();
        $cities = City::distinct()->orderBy('name')->get();
        $carTypes = CarType::distinct()->orderBy('name')->get();
        $fuelTypes = FuelType::distinct()->orderBy('name')->get();

        return view("car.create", [
            "makers" => $makers,
            "models" => $models,
            "states" => $states,
            "cities" => $cities,
            "carTypes" => $carTypes,
            "fuelTypes" => $fuelTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view("car.show", ["car" => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view("car.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        try {
            $car->delete();
            return redirect()->back()->with('success', 'Car deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete car. Please try again.');
        }
    }

    public function search(Request $request)
    {
        $query = Car::select("cars.*")->where("published_at", "<", now())
            ->with(["city", "maker", "model", "carType", "fuelType", "primaryImage"])
            ;

        // Filter by Maker
        if ($request->filled('maker_id')) {
            $query->where('maker_id', $request->maker_id);
        }

        // Filter by Model
        if ($request->filled('model_id')) {
            $query->where('model_id', $request->model_id);
        }

        // Filter by State (through City relation)
        if ($request->filled('state_id')) {
            $query->whereHas('city', function ($q) use ($request) {
                $q->where('state_id', $request->state_id);
            });
        }

        // Filter by City
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // Filter by Car Type
        if ($request->filled('car_type_id')) {
            $query->where('car_type_id', $request->car_type_id);
        }

        // Filter by Year range
        if ($request->filled('year_from')) {
            $query->where('year', '>=', $request->year_from);
        }
        if ($request->filled('year_to')) {
            $query->where('year', '<=', $request->year_to);
        }

        // Filter by Price range
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        // Filter by Fuel Type
        if ($request->filled('fuel_type_id')) {
            $query->where('fuel_type_id', $request->fuel_type_id);
        }

        // Mileage (optional)
        if ($request->filled('mileage')) {
            $query->where('mileage', '<=', $request->mileage);
        }

        // Ordering
        if ($request->filled('sort')) {
            if ($request->sort === 'price') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === '-price') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort === 'year') {
                $query->orderBy('year', 'asc');
            } elseif ($request->sort === '-year') {
                $query->orderBy('year', 'desc');
            } elseif ($request->sort === 'mileage') {
                $query->orderBy('mileage', 'asc');
            } elseif ($request->sort === '-mileage') {
                $query->orderBy('mileage', 'desc');
            }
        }


        $cars = $query->orderBy("published_at", "desc")->paginate(15)->appends($request->query());

        $makers = Maker::distinct()->orderBy('name')->get();
        $models = Model::distinct()->orderBy('name')->get();
        $states = State::distinct()->orderBy('name')->get();
        $cities = City::distinct()->orderBy('name')->get();
        $carTypes = CarType::distinct()->orderBy('name')->get();
        $fuelTypes = FuelType::distinct()->orderBy('name')->get();

        return view("car.search", [
            "cars" => $cars,
            "makers" => $makers,
            "models" => $models,
            "states" => $states,
            "cities" => $cities,
            "carTypes" => $carTypes,
            "fuelTypes" => $fuelTypes,
        ]);
    }

    public function watchlist()
    {
        // TODO we come back to this
        $cars = User::find(4)
            ->favouriteCars()
            ->with(["city", "maker", "model", "carType", "fuelType", "primaryImage"])
            ->paginate(15);

        return view("car.watchlist", ["cars" => $cars]);
    }

    public function toggleFavourite($carId)
    {
        $car = Car::findOrFail($carId);
        $user = User::where("id", $car->user_id)->first();

        if($user->favouriteCars()->where("car_id", $carId)->exists()) {
            $user->favouriteCars()->detach($carId);
            return response()->json(['status' => 'removed']);
        } else {
            $user->favouriteCars()->attach($carId);
            return response()->json(['status' => 'added']);
        }
    }

    public function image(Car $car)
    {
        return view("car.image", ["car" => $car]);
    }
}
