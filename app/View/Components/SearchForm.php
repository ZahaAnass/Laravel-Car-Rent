<?php

namespace App\View\Components;

use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchForm extends Component
{
    /**
     * Create a new component instance.
     */

    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $makers = Maker::distinct()->orderBy('name')->get();
        $models = Model::distinct()->orderBy('name')->get();
        $states = State::distinct()->orderBy('name')->get();
        $cities = City::distinct()->orderBy('name')->get();
        $carTypes = CarType::distinct()->orderBy('name')->get();
        $fuelTypes = FuelType::distinct()->orderBy('name')->get();

        return view('components.search-form', [
            'makers' => $makers,
            'models' => $models,
            'states' => $states,
            'cities' => $cities,
            'carTypes' => $carTypes,
            'fuelTypes' => $fuelTypes,
        ]);
    }

    /*
        * Do not use these public properties or methods.
        * - data
        * - render
        * - resolveView
        * - shouldRender
        * - view
        * - withAttributes
        * - withName
    */


    public function test()
    {
        return "Somthing";
    }
}
