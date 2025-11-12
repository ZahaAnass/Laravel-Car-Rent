<x-app-layout>
    <main>
        <!-- Found Cars -->
        <section>
            <div class="container">
                <div class="sm:flex items-center justify-between mb-medium">
                    <div class="flex items-center">
                        <button class="show-filters-button flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" style="width: 20px">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
                            </svg>
                            Filters
                        </button>
                        <h2>Define your search criteria</h2>
                    </div>
                    <form method="get" action="{{ route('car.search') }}">
                        <select class="sort-dropdown" name="sort" onchange="this.form.submit()">
                            <option value="">Order By</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price Asc</option>
                            <option value="-price" {{ request('sort') == '-price' ? 'selected' : '' }}>Price Desc</option>
                        </select>
                    </form>
                </div>
                <div class="search-car-results-wrapper">
                    <div class="search-cars-sidebar">
                        <div class="card card-found-cars">
                            <p class="m-0">Found <strong>{{ $cars->total() }}</strong> cars</p>

                            <button class="close-filters-button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width: 24px">
                                    <path fill-rule="evenodd"
                                        d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <!-- Find a car form -->
                        <section class="find-a-car">
                            <form method="GET" class="find-a-car-form card flex p-medium">
                                <div class="find-a-car-inputs">
                                    {{-- Maker --}}
                                    <div class="form-group">
                                        <label class="mb-medium">Maker</label>
                                        <select id="makerSelect" name="maker_id">
                                            <option value="" {{ !request('maker_id') ? 'selected' : '' }}>Maker</option>
                                            @foreach($makers as $maker)
                                                <option value="{{ $maker->id }}" {{ request('maker_id') == $maker->id ? 'selected' : '' }}>
                                                    {{ $maker->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Model --}}
                                    <div class="form-group">
                                        <label class="mb-medium">Model</label>
                                        <select id="modelSelect" name="model_id">
                                            <option value="" {{ !request('model_id') ? 'selected' : '' }}>Model</option>
                                            @foreach($models as $model)
                                                <option value="{{ $model->id }}"
                                                        data-parent="{{ $model->maker_id }}"
                                                        style="display: {{ request('maker_id') == $model->maker_id ? 'block' : 'none' }}"
                                                    {{ request('model_id') == $model->id ? 'selected' : '' }}>
                                                    {{ $model->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Type --}}
                                    <div class="form-group">
                                        <label class="mb-medium">Type</label>
                                        <select name="car_type_id">
                                            <option value="" {{ !request('car_type_id') ? 'selected' : '' }}>Type</option>
                                            @foreach($carTypes as $carType)
                                                <option value="{{ $carType->id }}" {{ request('car_type_id') == $carType->id ? 'selected' : '' }}>
                                                    {{ $carType->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Year --}}
                                    <div class="form-group">
                                        <label class="mb-medium">Year</label>
                                        <div class="flex gap-1">
                                            <input type="number" placeholder="Year From" name="year_from" value="{{ request('year_from') }}" />
                                            <input type="number" placeholder="Year To" name="year_to" value="{{ request('year_to') }}" />
                                        </div>
                                    </div>

                                    {{-- Price --}}
                                    <div class="form-group">
                                        <label class="mb-medium">Price</label>
                                        <div class="flex gap-1">
                                            <input type="number" placeholder="Price From" name="price_from" value="{{ request('price_from') }}" />
                                            <input type="number" placeholder="Price To" name="price_to" value="{{ request('price_to') }}" />
                                        </div>
                                    </div>

                                    {{-- Mileage --}}
                                    <div class="form-group">
                                        <label class="mb-medium">Mileage</label>
                                        <div class="flex gap-1">
                                            <select name="mileage">
                                                <option value="">Any Mileage</option>
                                                @foreach([10000,20000,30000,40000,50000,60000,70000,80000,90000,100000,150000,200000,250000,300000] as $m)
                                                    <option value="{{ $m }}" {{ request('mileage') == $m ? 'selected' : '' }}>
                                                        {{ number_format($m) }} or less
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- State --}}
                                    <div class="form-group">
                                        <label class="mb-medium">State</label>
                                        <select id="stateSelect" name="state_id">
                                            <option value="" {{ !request('state_id') ? 'selected' : '' }}>State/Region</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}" {{ request('state_id') == $state->id ? 'selected' : '' }}>
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- City --}}
                                    <div class="form-group">
                                        <label class="mb-medium">City</label>
                                        <select id="citySelect" name="city_id">
                                            <option value="" {{ !request('city_id') ? 'selected' : '' }}>City</option>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id }}"
                                                        data-parent="{{ $city->state_id }}"
                                                        style="display: {{ request('state_id') == $city->state_id ? 'block' : 'none' }}"
                                                    {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Fuel Type --}}
                                    <div class="form-group">
                                        <label class="mb-medium">Fuel Type</label>
                                        <select name="fuel_type_id">
                                            <option value="" {{ !request('fuel_type_id') ? 'selected' : '' }}>Fuel Type</option>
                                            @foreach($fuelTypes as $fuelType)
                                                <option value="{{ $fuelType->id }}" {{ request('fuel_type_id') == $fuelType->id ? 'selected' : '' }}>
                                                    {{ $fuelType->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="flex">
                                    <button type="button" class="btn btn-find-a-car-reset" onclick="window.location.href='{{ route('car.search') }}'">
                                        Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-find-a-car-submit">
                                        Search
                                    </button>
                                </div>
                            </form>
                        </section>
                        <!--/ Find a car form -->

                    </div>

                    <div class="search-cars-results">
                        <div class="car-items-listing">
                            @foreach ($cars as $car)
                                <x-car-item :$car />
                            @endforeach
                        </div>
                        {{ $cars->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </section>
        <!--/ Found Cars -->
    </main>
</x-app-layout>
