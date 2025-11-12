<!-- Find a car form -->
<section class="find-a-car">
<div class="container">
    <form
        action="{{ route('car.search') }}"
        method="GET"
        class="find-a-car-form card flex p-medium"
    >
    <div class="find-a-car-inputs">
        <div>
            <select id="makerSelect" name="maker_id">
                <option value="" selected disabled>Maker</option>
                @foreach($makers as $maker)
                    <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
        <select id="modelSelect" name="model_id">
            <option value="" style="display: block">Model</option>
            @foreach($models as $model)
                <option value="{{ $model->id }}" data-parent="{{ $model->maker_id }}" style="display: none">
                    {{ $model->name }}
                </option>
            @endforeach
        </select>
        </div>
        <div>
        <select id="stateSelect" name="state_id">
            <option value="" selected disabled>State/Region</option>
            @foreach($states as $state)
                <option value="{{ $state->id }}">{{ $state->name }}</option>
            @endforeach
        </select>
        </div>
        <div>
        <select id="citySelect" name="city_id">
            <option value="" style="display: block">City</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}" data-parent="{{ $city->state_id }}" style="display: none">
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
        </div>
        <div>
        <select name="car_type_id">
            <option value="">Type</option>
            @foreach($carTypes as $carType)
                <option value="{{ $carType->id }}">{{ $carType->name }}</option>
            @endforeach
        </select>
        </div>
        <div>
            <input type="number" placeholder="Year From" name="year_from" />
        </div>
        <div>
            <input type="number" placeholder="Year To" name="year_to" />
        </div>
        <div>
        <input
            type="number"
            placeholder="Price From"
            name="price_from"
        />
        </div>
        <div>
            <input type="number" placeholder="Price To" name="price_to" />
        </div>
        <div>
            <select name="fuel_type_id">
                <option value="">Fuel Type</option>
                @foreach($fuelTypes as $fuelType)
                    <option value="{{ $fuelType->id }}">{{ $fuelType->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <button type="reset" class="btn btn-find-a-car-reset">
            Reset
        </button>
        <button class="btn btn-primary btn-find-a-car-submit">
            Search
        </button>
    </div>
    </form>
</div>
</section>
<!--/ Find a car form -->
