<x-admin.layout>
    <main>
        <div>
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

                @error('image')
                    <div class="alert error-alert">
                        <span><strong>❌ Error:</strong> {{ $message }}</span>
                        <button class="close-btn" onclick="this.parentElement.remove()">×</button>
                    </div>
                @enderror

                <h1 class="car-details-page-title">
                    Manage Images for: {{ $car->year }} - {{ $car->maker->name }} {{ $car->model->name }}
                </h1>

                <div class="car-images-wrapper">

                    {{-- =========================
                        UPDATE POSITIONS + DELETE
                    ========================== --}}
                    <form method="POST" class="card p-medium form-update-images" action="{{ route('admin.cars.updatePositions', $car->id) }}">
                        @csrf
                        @method('POST')

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Delete</th>
                                    <th>Image</th>
                                    <th>Position</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($car->images as $image)
                                    <tr>
                                        <td>
                                            <input
                                                type="checkbox"
                                                name="delete_images[]"
                                                value="{{ $image->id }}"
                                            >
                                        </td>

                                        <td>
                                            <img src="{{ $image->image_path }}"
                                                class="my-cars-img-thumbnail"
                                                style="width: 120px"
                                                alt="car image">
                                        </td>

                                        <td>
                                            <input type="number" min="0"
                                                   name="positions[{{ $image->id }}]"
                                                   value="{{ $image->position }}"
                                                   style="width: 80px">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="p-medium" style="width: 100%">
                            <div class="flex justify-end" style="gap: 0.8rem;">

                                {{-- Update Positions --}}
                                <button
                                    formaction="{{ route('admin.cars.updatePositions', $car->id) }}"
                                    class="btn btn-primary">
                                    Update Positions
                                </button>

                                {{-- Delete Images --}}
                                <button
                                    formaction="{{ route('admin.cars.deleteImages', $car->id) }}"
                                    class="btn btn-danger">
                                    Delete Selected
                                </button>

                            </div>
                        </div>
                    </form>

                    {{-- =========================
                        ADD ONE IMAGE
                    ========================== --}}
                    <form
                        action="{{ route('admin.cars.addImage', $car) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="card form-images p-medium mb-large"
                    >
                        @csrf

                        <div class="form-image-upload">
                            <div class="upload-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 48px">
                                    <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                            </div>

                            <input
                                id="carFormImageUpload"
                                type="file"
                                name="image"
                                accept="image/*"
                                required
                            />
                        </div>
                        <div id="imagePreviews" class="car-form-images"></div>

                        <div class="p-medium" style="width: 100%">
                            <div class="flex justify-end gap-1">
                                <button class="btn btn-primary">Add Image</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-admin.layout>
