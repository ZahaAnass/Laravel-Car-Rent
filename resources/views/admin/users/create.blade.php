<x-admin.layout>
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Add New User</h1>

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

            <form action="{{ route('admin.users.store') }}" method="POST" class="card add-new-car-form">
                @csrf

                <div class="form-content">
                    <div class="form-details">

                        {{-- Row 1: Name + Email --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" placeholder="Full name" required value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="email" placeholder="Email address" required value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Row 2: Phone + Role --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input name="phone" type="text" placeholder="Phone number" value="{{ old('phone') }}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" required>
                                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Row 3: Password --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="password" placeholder="Password" required>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input name="password_confirmation" type="password" placeholder="Confirm password" required>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="p-medium" style="width: 100%">
                    <div class="flex justify-end gap-1">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-default">Cancel</a>
                        <button class="btn btn-primary">Create User</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</x-admin.layout>
