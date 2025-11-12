<x-app-layout>
    <main>
        <div>
            <div class="container">
                <h1 class="car-details-page-title">
                    Manage Images for: {{ $car->year }} - {{ $car->maker->name }} {{ $car->model->name }}
                </h1>

                <div class="car-images-wrapper">
                    <form
                        action=""
                        method="POST"
                        class="card p-medium form-update-images"
                    >
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
                                                id="delete_image_{{ $image->id }}"
                                                value="{{ $image->id }}"
                                            />
                                        </td>
                                        <td>
                                            <img
                                                src="{{ $image->image_path }}"
                                                alt=""
                                                class="my-cars-img-thumbnail"
                                                style="width: 120px"
                                            />
                                        </td>
                                        <td>
                                            <input
                                                type="number"
                                                name="positions[{{ $image->id }}]"
                                                value="{{ $image->position }}"
                                                style="width: 80px"
                                            />
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="p-medium" style="width: 100%">
                            <div class="flex justify-end gap-1">
                                <button class="btn btn-primary">Update Images</button>
                            </div>
                        </div>
                    </form>
                    <form
                        action=""
                        method="POST"
                        enctype="multipart/form-data"
                        class="card form-images p-medium mb-large"
                    >
                        <div class="form-image-upload">
                            <div class="upload-placeholder">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    style="width: 48px"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>
                            </div>
                            <input
                                id="carFormImageUpload"
                                type="file"
                                name="images[]"
                                multiple
                                accept="image/*"
                            />
                        </div>
                        <div id="imagePreviews" class="car-form-images"></div>

                        <div class="p-medium" style="width: 100%">
                            <div class="flex justify-end gap-1">
                                <button class="btn btn-primary">Add Images</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
