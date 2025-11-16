@props(["car", "isInWatchlist" => false])

<div class="car-item card">
    <a href="{{ route('car.show', $car->id) }}">
        <img src="{{ $car->primaryImage->image_path }}"
            alt=""
            class="car-item-img rounded-t"/>
    </a>
    <div class="p-medium">
        <div class="flex items-center justify-between">
            <small class="m-0 text-muted">{{ $car->city->name }}</small>
            <form action="{{ route("favourite.toggle", $car->id) }}" method="post">
                @csrf
                <button class="btn-heart">
                <!-- EMPTY HEART (outline) -->
                <svg class="{{ $isInWatchlist ? 'hidden' : '' }}"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     style="width: 20px">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 8.25C21 5.765 18.901 3.75 16.312 3.75c-1.935 0-3.597 1.126-4.312 2.733C11.285 4.876 9.623 3.75 7.688 3.75 5.099 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                </svg>

                <!-- FILLED HEART (red) -->
                <svg class="{{ $isInWatchlist ? '' : 'hidden' }}"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="red"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="red"
                     style="width: 20px">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 8.25C21 5.765 18.901 3.75 16.312 3.75c-1.935 0-3.597 1.126-4.312 2.733C11.285 4.876 9.623 3.75 7.688 3.75 5.099 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                    />
                </svg>
            </button>
            </form>
        </div>
        <h2 class="car-item-title">
            {{ $car->year }}- {{ $car->maker->name }} {{ $car->model->name }}
        </h2>
        <p class="car-item-price">${{ $car->price }}</p>
        <hr/>
        <p class="m-0">
            <span class="car-item-badge">{{ $car->carType->name }}</span>
            <span class="car-item-badge">{{ $car->fuelType->name }}</span>
        </p>
    </div>
</div>
