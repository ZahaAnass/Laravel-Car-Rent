<x-guest-layout title="Login" bodyClass="page-login">
    <h1 class="auth-page-title">Login</h1>

    @if (session('success'))
        <div class="alert success-alert">
            <span><strong>✅ Success:</strong> {{ session('success') }}</span>
            <button class="close-btn" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif


    <form action="{{ route('login.post') }}" method="post">
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

        <div class="text-right mb-medium">
            <a href="{{ route("password-reset") }}" class="auth-page-password-reset">Reset Password</a>
        </div>
        <button class="btn btn-primary btn-login w-full">Login</button>
    </form>

    <x-slot:footerLink>
        Don't have an account? -
        <a href="/signup"> Click here to signup </a>
    </x-slot:footerLink>
</x-guest-layout>
