<x-admin.layout>
    <h1>All Cars</h1>
    <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">Add New Car</a>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Maker</th>
            <th>Year</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>{{ $car->model->name }}</td>
                <td>{{ $car->maker->name }}</td>
                <td>{{ $car->year }}</td>
                <td>${{ $car->price }}</td>
                <td>
                    <a href="{{ route('admin.cars.show', $car->id) }}">View</a>
                    <a href="{{ route('admin.cars.edit', $car->id) }}">Edit</a>
                    <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $cars->links() }}
</x-admin.layout>
