<x-app-layout bodyClass="page-profile">
    <main>
        <div>

            {{-- Success message --}}
            @if (session('success'))
                <div class="alert success-alert">
                    <span><strong>✅ Success:</strong> {{ session('success') }}</span>
                    <button class="close-btn" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            {{-- Info message --}}
            @if (session('info'))
                <div class="alert info-alert">
                    <span><strong>ℹ️ Info:</strong> {{ session('info') }}</span>
                    <button class="close-btn" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            {{-- Error message --}}
            @if (session('error'))
                <div class="alert error-alert">
                    <span><strong>❌ Error:</strong> {{ session('error') }}</span>
                    <button class="close-btn" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            <div class="container">
                <h1 class="page-title">My Profile</h1>

                <div class="card p-medium">

                    {{-- UPDATE PROFILE FORM --}}
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <h2>Update Profile Info</h2>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input required id="name" class="form-control" type="text"
                                    name="name" value="{{ old('name', $user->name) }}" >
                            @error('name')
                            <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input required id="email" class="form-control" type="email"
                                    name="email" value="{{ old('email', $user->email) }}" >
                            @error('email')
                            <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-full">
                            Update Profile
                        </button>
                    </form>

                    <hr>

                    {{-- UPDATE PASSWORD FORM --}}
                    <form method="POST" action="{{ route('profile.updatePassword') }}">
                        @csrf
                        @method('PATCH')

                        <h2>Change Password</h2>

                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input required id="current_password" class="form-control" type="password" name="current_password">
                            @error('current_password')
                            <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input required id="password" class="form-control" type="password" name="password">
                            @error('password')
                            <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input required id="password_confirmation" class="form-control"
                                    type="password" name="password_confirmation">
                            @error('password_confirmation')
                            <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-full">
                            Update Password
                        </button>
                    </form>

                    <hr>

                    {{-- DELETE ACCOUNT FORM --}}
                    <form action="{{ route('profile.deleteAccount') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-delete w-full"
                                onclick="return confirm('Are you sure you want to delete your account? This cannot be undone.')">
                            Delete Account
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </main>
</x-app-layout>
