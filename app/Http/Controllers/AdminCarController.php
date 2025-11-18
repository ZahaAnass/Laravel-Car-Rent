<?php

namespace App\Http\Controllers;

use App\Models\Car;
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
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
