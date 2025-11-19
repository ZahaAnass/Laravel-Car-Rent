<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarFeatures;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
use App\Models\User;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = User::find(auth()->id())
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
        $request->validate([
            'maker_id' => 'required|exists:makers,id',
            'model_id' => 'required|exists:models,id',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'vin' => 'required|string|max:50',
            'mileage' => 'required|integer|min:0',
            'city_id' => 'required|exists:cities,id',
            'car_type_id' => 'required|exists:car_types,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // Create the car
        $car = Car::create([
            'user_id' => auth()->id(),
            'maker_id' => $request->maker_id,
            'model_id' => $request->model_id,
            'year' => $request->year,
            'price' => $request->price,
            'vin' => $request->vin,
            'mileage' => $request->mileage,
            'city_id' => $request->city_id,
            'car_type_id' => $request->car_type_id,
            'fuel_type_id' => $request->fuel_type_id,
            'address' => $request->address,
            'phone' => $request->phone,
            'description' => $request->description,
            'published_at' => $request->has('published') ? now() : null,
        ]);

        // Store one image only
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $uniqueId = uniqid();

            // Example result: cars/ToyotaCorolla_654f9b1234a8c.jpg
            $fileName = $originalName . '_' . $uniqueId . '.' . $extension;

            // Save in storage/app/public/cars/
            $path = $file->storeAs('cars', $fileName, 'public');

            $image = $car->images()->create([
                'image_path' => "/storage/" . $path,
                'position' => 1,
            ]);

        }


        // Save car features
        $car->features()->create([
            'air_conditioning' => isset($request->features['air_conditioning']),
            'power_windows' => isset($request->features['power_windows']),
            'power_door_locks' => isset($request->features['power_door_locks']),
            'abs' => isset($request->features['abs']),
            'remote_start' => isset($request->features['remote_start']),
            'gps_navigation' => isset($request->features['gps_navigation']),
            'heated_seats' => isset($request->features['heated_seats']),
            'climate_control' => isset($request->features['climate_control']),
            'rear_parking_sensors' => isset($request->features['rear_parking_sensors']),
            'leather_seats' => isset($request->features['leather_seats']),
        ]);

        return redirect()->route('car.show', $car)->with('success', 'Car created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $car = Car::where("id", $car->id)
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
            ->first();

        return view("car.show", ["car" => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        if ($car->user_id !== auth()->id()) {
            return redirect()->route('car.index')->with('error', 'You are not authorized to edit this car.');
        }

        $makers = Maker::orderBy('name')->get();
        $models = Model::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        $carTypes = CarType::orderBy('name')->get();
        $fuelTypes = FuelType::orderBy('name')->get();
        $features = CarFeatures::where('car_id', $car->id)->first();

        return view("car.edit", compact(
            'car', 'makers', 'models', 'states', 'cities', 'carTypes', 'fuelTypes', 'features'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        try {
            $request->validate([
                'maker_id' => 'required|exists:makers,id',
                'model_id' => 'required|exists:models,id',
                'year' => 'required|integer|min:1900|max:' . date('Y'),
                'price' => 'required|numeric|min:0',
                'vin' => 'required|string|max:50',
                'mileage' => 'required|integer|min:0',
                'city_id' => 'required|exists:cities,id',
                'car_type_id' => 'required|exists:car_types,id',
                'fuel_type_id' => 'required|exists:fuel_types,id',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'description' => 'required|string',
            ]);

            // 2. Update car data
            $car->update([
                'maker_id' => $request->maker_id,
                'model_id' => $request->model_id,
                'year' => $request->year,
                'price' => $request->price,
                'vin' => $request->vin,
                'mileage' => $request->mileage,
                'city_id' => $request->city_id,
                'car_type_id' => $request->car_type_id,
                'fuel_type_id' => $request->fuel_type_id,
                'address' => $request->address,
                'phone' => $request->phone,
                'description' => $request->description,

                // If checkbox checked => publish, else unpublish
                'published_at' => $request->has('published') ? now() : null,
            ]);

            // 3. Update Features (table car_features)
            $features = [
                'air_conditioning',
                'power_windows',
                'power_door_locks',
                'abs',
                'remote_start',
                'gps_navigation',
                'heated_seats',
                'climate_control',
                'rear_parking_sensors',
                'leather_seats',
            ];

            // Check if features row exists
            $carFeatures = CarFeatures::firstOrNew(['car_id' => $car->id]);

            foreach ($features as $f) {
                $carFeatures->$f = isset($request->features[$f]);
            }
            $carFeatures->save();

        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Failed to update car. Please try again.');
        }

        return redirect()->route('car.show', $car)->with('success', 'Car updated successfully!');
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
        $cars = User::find(auth()->id())
            ->favouriteCars()
            ->with(["city", "maker", "model", "carType", "fuelType", "primaryImage"])
            ->paginate(15);

        return view("car.watchlist", ["cars" => $cars]);
    }

    public function toggleFavourite($carId)
    {
        $car = Car::findOrFail($carId);
        $user = User::where("id", auth()->id())->first();

        if($user->favouriteCars()->where("car_id", $carId)->exists()) {
            $user->favouriteCars()->detach($carId);
            return back()->with('status', 'Removed from favourites');
        } else {
            $user->favouriteCars()->attach($carId);
            return back()->with('status', 'Added to favourites');
        }
    }

    public function image(Car $car)
    {
        return view("car.image", ["car" => $car]);
    }

    public function addImage(Request $request, Car $car)
    {
        $request->validate([
            'image' => 'required|image|max:8192', // Max 8MB
        ]);

        $path = $request->file('image')->store('cars', 'public');

        $car->images()->create([
            'image_path' => '/storage/' . $path,
            'position' => $car->images()->max('position') + 1
        ]);

        return back()->with('success', 'Image added successfully.');
    }

    public function updatePositions(Request $request, Car $car)
    {
        $request->validate([
            'positions' => 'required|array',
            'positions.*' => 'required|integer|min:1',
        ]);

        foreach ($request->positions as $id => $pos) {
            $car->images()->where('id', $id)->update([
                'position' => $pos
            ]);
        }

        return back()->with('success', 'Positions updated.');
    }

    public function deleteImages(Request $request, Car $car)
    {
        $ids = $request->delete_images;

        $car->images()->whereIn('id', $ids)->delete();

        return back()->with('success', 'Images deleted.');
    }

}
