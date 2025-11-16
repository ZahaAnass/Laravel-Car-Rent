<x-guest-layout title="Signup" bodyClass="page-signup">
    <h1 class="auth-page-title" id="title">Signup</h1>

    <form action="{{ route('signup.post') }}" method="POST">
        @csrf

        {{-- GLOBAL ALERT --}}
        @if ($errors->any())
            <div class="alert error-alert">
                <span><strong>Error: </strong> Please fix the fields below.</span>
                <button class="close-btn" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        {{-- EMAIL --}}
        <div class="form-group">
            <input required type="email" placeholder="Your Email" name="email" value="{{ old('email') }}" />
            @error('email')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- PASSWORD --}}
        <div class="form-group">
            <input required type="password" placeholder="Your Password" name="password" />
            @error('password')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- CONFIRM PASSWORD --}}
        <div class="form-group">
            <input required type="password" placeholder="Repeat Password" name="confirmPassword" />
            @error('confirmPassword')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <hr />

        {{-- NAME --}}
        <div class="form-group">
            <input required type="text" placeholder="Name" name="name" value="{{ old('name') }}" />
            @error('name')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- PHONE --}}
        <div class="form-group">
            <input required type="text" placeholder="Phone" name="phone" value="{{ old('phone') }}" />
            @error('phone')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary btn-login w-full">Register</button>
    </form>

    @slot("footerLink")
        Already have an account? -
        <a href="{{ route("login") }}"> Click here to login </a>
    @endslot
</x-guest-layout>
