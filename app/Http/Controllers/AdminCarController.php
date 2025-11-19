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
use Illuminate\Http\Request;

class AdminCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::with(["maker", "model", "primaryImage"])
            ->orderBy("created_at", "desc")
            ->paginate(15);

        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where("role", "user")->orderBy("name")->get();
        $makers = Maker::distinct()->orderBy('name')->get();
        $models = Model::distinct()->orderBy('name')->get();
        $states = State::distinct()->orderBy('name')->get();
        $cities = City::distinct()->orderBy('name')->get();
        $carTypes = CarType::distinct()->orderBy('name')->get();
        $fuelTypes = FuelType::distinct()->orderBy('name')->get();

        return view("admin.cars.create", [
            "makers" => $makers,
            "models" => $models,
            "states" => $states,
            "cities" => $cities,
            "carTypes" => $carTypes,
            "fuelTypes" => $fuelTypes,
            "users" => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "user_id" => 'required|exists:users,id',
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
            'user_id' => $request->user_id,
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

        return redirect()->route('admin.cars.show', $car)->with('success', 'Car created successfully!');
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
            ])->first();

        return view("admin.cars.show", ["car" => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $makers = Maker::orderBy('name')->get();
        $models = Model::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        $carTypes = CarType::orderBy('name')->get();
        $fuelTypes = FuelType::orderBy('name')->get();
        $features = CarFeatures::where('car_id', $car->id)->first();
        $currentUserId = $car->user_id;
        $users = User::where("role", "user")->orderBy("name")->get();

        return view("admin.cars.edit", [
            "car" => $car,
            "makers" => $makers,
            "models" => $models,
            "states" => $states,
            "cities" => $cities,
            "carTypes" => $carTypes,
            "fuelTypes" => $fuelTypes,
            "features" => $features,
            "currentUserId" => $currentUserId,
            "users" => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        try {
            $request->validate([
                "user_id" => 'required|exists:users,id',
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
                'user_id' => $request->user_id,
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

        return redirect()->route('admin.cars.show', $car)->with('success', 'Car updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::findOrFail($id);

        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully!');
    }

    public function image(Car $car)
    {

    }

    public function addImage(Car $car)
    {

    }

    public function updatePositions(Car $car)
    {

    }

    public function deleteImages(Car $car)
    {

    }
}
