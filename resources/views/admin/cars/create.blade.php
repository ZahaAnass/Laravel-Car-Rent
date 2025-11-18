<x-app-layout>
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Add new car</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="card add-new-car-form">
                @csrf
                <div class="form-content">
                    <div class="form-details">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Car Owner</label>
                                    <select required name="user_id">
                                        <option value="">Select Owner</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Maker</label>
                                    <select required id="makerSelect" name="maker_id" required>
                                        <option value="">Maker</option>
                                        @foreach($makers as $maker)
                                            <option value="{{ $maker->id }}" {{ request('maker_id') == $maker->id ? 'selected' : '' }}>
                                                {{ $maker->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="error-message">This field is required</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Model</label>
                                    <select required id="modelSelect" name="model_id">
                                        <option value="">Model</option>
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
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select required name="year">
                                        <option value="">Year</option>
                                        @for($year = date('Y'); $year >= 1990; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Car Type</label>
                            <div class="row">
                                @foreach($carTypes as $carType)
                                    <div class="col">
                                        <label class="inline-radio">
                                            <input required type="radio" name="car_type_id" value="{{ $carType->id }}" />
                                            {{ $carType->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input required name="price" type="number" min="0" placeholder="Price" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Vin Code</label>
                                    <input required placeholder="Vin Code" name="vin"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Mileage (km)</label>
                                    <input required placeholder="Mileage" name="mileage" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fuel Type</label>
                            <div class="row">
                                @foreach($fuelTypes as $fuelType)
                                    <div class="col">
                                        <label class="inline-radio">
                                            <input required type="radio" name="fuel_type_id" value="{{ $fuelType->id }}" />
                                            {{ $fuelType->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label>State/Region</label>
                                    <select required id="stateSelect" name="state_id">
                                        <option value="" {{ !request('state_id') ? 'selected' : '' }}>State/Region</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" {{ request('state_id') == $state->id ? 'selected' : '' }}>
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input required placeholder="Address" name="address"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input required placeholder="Phone" name="phone" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                @php
                                    $specs = [
                                        'air_conditioning'      => 'Air Conditioning',
                                        'power_windows'         => 'Power Windows',
                                        'power_door_locks'      => 'Power Door Locks',
                                        'abs'                   => 'ABS',
                                        'remote_start'          => 'Remote Start',
                                        'gps_navigation'        => 'GPS Navigation System',
                                        'heated_seats'          => 'Heated Seats',
                                        'climate_control'       => 'Climate Control',
                                        'rear_parking_sensors'  => 'Rear Parking Sensors',
                                        'leather_seats'         => 'Leather Seats',
                                    ];
                                @endphp

                                <ul class="car-specifications">
                                    @foreach($specs as $column => $label)
                                        <li>
                                            <label class="checkbox">
                                                <input type="checkbox" name="features[{{ $column }}]" />
                                                {{ $label }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Detailed Description</label>
                            <textarea required name="description" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="checkbox">
                                <input type="checkbox" name="published" />
                                Published
                            </label>
                        </div>
                    </div>
                    <div class="form-images">
                        <div class="form-image-upload">
                            <div class="upload-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" style="width: 48px">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <input required id="carFormImageUpload" type="file" name="image" />
                        </div>
                        <div id="imagePreviews" class="car-form-images"></div>
                    </div>
                </div>
                <div class="p-medium" style="width: 100%">
                    <div class="flex justify-end gap-1">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
