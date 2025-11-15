<x-app-layout>
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Edit Car - {{ $car->maker->name ?? '' }} {{ $car->model->name ?? '' }}</h1>
            @if (session('success'))
                <div class="alert success-alert">
                    <span><strong>✅ Success:</strong> {{ session('success') }}</span>
                    <button class="close-btn" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert error-alert">
                    <span><strong>❌ Error:</strong> {{ session('error') }}</span>
                    <button class="close-btn" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('car.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="card add-new-car-form">
                @csrf
                @method('PUT')

                <div class="form-content">
                    <div class="form-details">
                        {{-- Maker / Model / Year --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Maker</label>
                                    <select required id="makerSelect" name="maker_id">
                                        <option value="">Maker</option>
                                        @foreach($makers as $maker)
                                            <option value="{{ $maker->id }}" {{ $car->maker_id == $maker->id ? 'selected' : '' }}>
                                                {{ $maker->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Model</label>
                                    <select required name="model_id" id="modelSelect">
                                        <option value="">Model</option>
                                        @foreach($models as $model)
                                            <option value="{{ $model->id }}"
                                                    {{ $car->model_id == $model->id ? 'selected' : '' }}
                                                    data-parent="{{ $model->maker_id }}">
                                                {{ $model->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select required name="year">
                                        @for($year = date('Y'); $year >= 1990; $year--)
                                            <option value="{{ $year }}" {{ $car->year == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Car Type --}}
                        <div class="form-group">
                            <label>Car Type</label>
                            <div class="row">
                                @foreach($carTypes as $carType)
                                    <div class="col">
                                        <label class="inline-radio">
                                            <input required type="radio" name="car_type_id" value="{{ $carType->id }}" {{ $car->car_type_id == $carType->id ? 'checked' : '' }}>
                                            {{ $carType->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Price / VIN / Mileage --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input required type="number" name="price" value="{{ $car->price }}" placeholder="Price" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Vin Code</label>
                                    <input required name="vin" value="{{ $car->vin }}" placeholder="Vin Code" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Mileage (km)</label>
                                    <input required name="mileage" value="{{ $car->mileage }}" placeholder="Mileage" />
                                </div>
                            </div>
                        </div>

                        {{-- Fuel Type --}}
                        <div class="form-group">
                            <label>Fuel Type</label>
                            <div class="row">
                                @foreach($fuelTypes as $fuelType)
                                    <div class="col">
                                        <label class="inline-radio">
                                            <input required type="radio" name="fuel_type_id" value="{{ $fuelType->id }}" {{ $car->fuel_type_id == $fuelType->id ? 'checked' : '' }}>
                                            {{ $fuelType->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- State / City --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>State/Region</label>
                                    <select required id="stateSelect" name="state_id">
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" {{ $car->city->state_id == $state->id ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>City</label>
                                    <select required id="citySelect" name="city_id">
                                        <option value="">City</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}"
                                                    data-parent="{{ $city->state_id }}"
                                                    {{ $car->city_id == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Address / Phone --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input required name="address" value="{{ $car->address }}" placeholder="Address" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input required name="phone" value="{{ $car->phone }}" placeholder="Phone" />
                                </div>
                            </div>
                        </div>

                        {{-- Features --}}
                        <div class="form-group">
                            <div class="row">
                                @php
                                    $specs = [
                                        'air_conditioning'      => 'Air Conditioning',
                                        'power_windows'         => 'Power Windows',
                                        'power_door_locks'      => 'Power Door Locks',
                                        'abs'                   => 'ABS',
                                        'remote_start'          => 'Remote Start',
                                        'gps_navigation'        => 'GPS Navigation',
                                        'heated_seats'          => 'Heated Seats',
                                        'climate_control'       => 'Climate Control',
                                        'rear_parking_sensors'  => 'Rear Parking Sensors',
                                        'leather_seats'         => 'Leather Seats',
                                    ];
                                @endphp

                                <ul class="car-specifications">
                                    @foreach($specs as $key => $label)
                                        <li>
                                            <label class="checkbox">
                                                <input type="checkbox" name="features[{{ $key }}]"
                                                    {{ isset($features[$key]) && $features[$key] ? 'checked' : '' }}>
                                                {{ $label }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label>Detailed Description</label>
                            <textarea required name="description" rows="10">{{ $car->description }}</textarea>
                        </div>

                        {{-- Published --}}
                        <div class="form-group">
                            <label class="checkbox">
                                <input type="checkbox" name="published" {{ $car->published_at ? 'checked' : '' }}>
                                Published
                            </label>
                        </div>
                    </div>

                    {{-- Images --}}
                    <div class="form-images">
                        <div id="imagePreviews" class="car-form-images">
                            @foreach($car->images ?? [] as $image)
                                <img src="{{ asset($image->image_path) }}" class="car-form-image" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="p-medium" style="width: 100%">
                    <div class="flex justify-end gap-1">
                        <a href="{{ route('car.index') }}" class="btn btn-default">Cancel</a>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
