<x-admin.layout>
    <main class="page-my-cars">
        <div>
            {{-- Alerts --}}
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

            <div class="container">
                <div class="mb-medium flex justify-between items-center">
                    <h1 class="car-details-page-title">User Details</h1>

                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary inline-flex items-center">
                        ← Back
                    </a>
                </div>

                <div class="card p-medium">
                    <h2 class="text-xl font-semibold mb-medium">User Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-medium">
                        <p><strong>ID:</strong> {{ $user->id }}</p>
                        <p><strong>Name:</strong> {{ $user->name }}</p>

                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>

                        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>

                        <p>
                            <strong>Email Verified:</strong>
                            {{ $user->email_verified_at ? $user->email_verified_at->format('d M Y, H:i') : 'Not Verified' }}
                        </p>

                        <p><strong>Created At:</strong> {{ $user->created_at->format('d M Y, H:i') }}</p>
                        <p><strong>Updated At:</strong> {{ $user->updated_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="mt-large flex items-center gap-medium">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit inline-flex items-center">
                            ✏️ Edit User
                        </a>

                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-delete inline-flex items-center">
                                🗑 Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-admin.layout>
