<x-admin.layout>
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Update User: {{ $user->name }}</h1>

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="alert error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ============ USER INFO FORM ============ --}}
            <form action="{{ route('admin.users.update', $user) }}"
                  method="POST"
                  class="card add-new-car-form">

                @csrf
                @method('PATCH')


                <div class="form-content">
                    <div class="form-details">
                        <h2 class="mb-4">User Information</h2>
                        {{-- Row 1: Name + Email --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name"
                                           type="text"
                                           placeholder="Full name"
                                           required
                                           value="{{ old('name', $user->name) }}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email"
                                           type="email"
                                           placeholder="Email address"
                                           required
                                           value="{{ old('email', $user->email) }}">
                                </div>
                            </div>
                        </div>

                        {{-- Row 2: Phone + Role --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input name="phone"
                                           type="text"
                                           placeholder="Phone number"
                                           value="{{ old('phone', $user->phone) }}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" required>
                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="p-medium" style="width: 100%">
                    <div class="flex justify-end gap-1">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-default">Cancel</a>
                        <button class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>


            {{-- ============ PASSWORD FORM ============ --}}
            <form action="{{ route('admin.users.updatePassword', $user) }}"
                  method="POST"
                  class="card add-new-car-form mt-6" style="margin-top: 2rem;">

                @csrf
                @method('PATCH')


                <div class="form-content">
                    <div class="form-details">
                        <h2 class="mb-4">Change Password</h2>
                        <p class="text-muted mb-3">Leave empty if you don't want to change the password.</p>
                        {{-- Row 3: New Password --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input name="password"
                                           type="password"
                                           placeholder="New password">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input name="password_confirmation"
                                           type="password"
                                           placeholder="Confirm password">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="p-medium" style="width: 100%">
                    <div class="flex justify-end gap-1">
                        <button class="btn btn-primary">Update Password</button>
                    </div>
                </div>
            </form>

        </div>
    </main>
</x-admin.layout>
