<x-admin.layout>
    <main>
        <div class="container">
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

            @if (session('status'))
                <div class="alert success-alert">
                    <span><strong>✅ Success:</strong> {{ session('status') }}</span>
                    <button class="close-btn" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif
            <h1 class="car-details-page-title">{{ $car->maker->name }} {{ $car->model->name }} - {{ $car->year }}</h1>
            <div class="car-details-region">{{ $car->city->name }} - {{ $car->published_at }}</div>

            <div class="car-details-content">
                <div class="car-images-and-description">
                    <div class="car-images-carousel">
                        <div class="car-image-wrapper">
                            <img src="{{ $car->primaryImage->image_path }}" alt="" class="car-active-image"
                                 id="activeImage" />
                        </div>
                        <div class="car-image-thumbnails">
                            @foreach($car->images as $image)
                                <img src="{{ $image->image_path }}" alt="car" />
                            @endforeach
                        </div>
                        <button class="carousel-button prev-button" id="prevButton">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" style="width: 64px">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        <button class="carousel-button next-button" id="nextButton">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" style="width: 64px">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>

                    <div class="card car-detailed-description">
                        <h2 class="car-details-title">Detailed Description</h2>
                        <p>
                            {!! $car->description !!} <!-- Displaying description from database in raw HTML format -->
                        </p>
                    </div>

                    <div class="card car-detailed-description">
                        <h2 class="car-details-title">Car Specifications</h2>

                        <ul class="car-specifications">
                            @php
                                $features = $car->features;
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
                                    <x-car-specification :value="$features?->$column">{{ $label }}</x-car-specification>
                                @endforeach
                            </ul>
                    </div>
                </div>
                <div class="car-details card">
                    <div class="flex items-center justify-between">
                        <p class="car-details-price">${{ $car->price }}</p>
                    </div>

                    <hr />
                    <table class="car-details-table">
                        <tbody>
                        <tr>
                            <th>Maker</th>
                            <td>{{ $car->maker->name}}</td>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <td>{{ $car->model->name }}</td>
                        </tr>
                        <tr>
                            <th>Year</th>
                            <td>{{ $car->year }}</td>
                        </tr>
                        <tr>
                            <th>Vin</th>
                            <td>{{ $car->vin }}</td>
                        </tr>
                        <tr>
                            <th>Mileage</th>
                            <td>{{ $car->mileage }} Km</td>
                        </tr>
                        <tr>
                            <th>Car Type</th>
                            <td>{{ $car->carType->name }}</td>
                        </tr>
                        <tr>
                            <th>Fuel Type</th>
                            <td>{{ $car->fuelType->name }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <hr />

                    <div class="flex gap-1 my-medium">
                        <img src="{{ asset('/img/avatar.png') }}" alt="" class="car-details-owner-image" />
                        <div>
                            <h3 class="car-details-owner">{{ $car->owner->name }}</h3>
                            <div class="text-muted">{{ $car->owner->cars->count() }} cars</div>
                        </div>
                    </div>
                    <a href="tel:{{ $car->phone }}" class="car-details-phone">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" style="width: 16px">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>

                        <!-- Masked -->
                        <span class="masked-phone">{{ \Illuminate\Support\Str::mask($car->phone, "*", -3) }}</span>
                        <!-- Full -->
                        <span class="displayed-phone" style="display: none;">{{ $car->phone }}</span>

                        <!-- Toggle links -->
                        <span class="car-details-phone-view show-number" style="cursor:pointer; color:#007bff;">
                            View full number
                        </span>
                        <span class="car-details-phone-view hide-number" style="display:none; cursor:pointer; color:#007bff;">
                            Hide number
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </main>
</x-admin.layout>
