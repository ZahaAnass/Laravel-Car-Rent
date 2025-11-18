<x-admin.layout>
    <div class="container">
        <h1 class="mb-medium" style="font-size:28px; font-weight:700;">Admin Dashboard</h1>
        <p class="text-muted mb-large">Welcome, <strong>{{ auth()->user()->name }}</strong> 👋</p>

        <div class="dashboard-cards">
            <div class="card admin-card">
                <h2 class="admin-card-title">Users</h2>
                <p class="admin-card-count">{{ $usersCount }} total</p>
                <a class="admin-card-link" href="{{ route('admin.users.index') }}">Manage Users →</a>
            </div>

            <div class="card admin-card">
                <h2 class="admin-card-title">Cars</h2>
                <p class="admin-card-count">{{ $carsCount }} total</p>
                <a class="admin-card-link" href="{{ route('admin.cars.index') }}">Manage Cars →</a>
            </div>
        </div>
    </div>
</x-admin.layout>
