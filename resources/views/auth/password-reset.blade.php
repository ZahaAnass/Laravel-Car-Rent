<x-guest-layout title="Signup" bodyClass="page-signup">

    <h1 class="auth-page-title">Request Password Reset</h1>

    @if(session('status'))
        <div class="alert success-alert">
            <span><strong>✅ Success:</strong> {{ session('status') }}</span>
            <button class="close-btn" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    @error('email')
        <div class="alert error-alert">
            <span><strong>⚠️ Error:</strong> {{ $message }}</span>
            <button class="close-btn" onclick="this.parentElement.remove()">×</button>
        </div>
    @enderror

    <form action="{{ route("password-reset.post") }}" method="post">
        @csrf
        <div class="form-group">
            <input type="email" placeholder="Your Email" name="email" />
        </div>

        <button class="btn btn-primary btn-login w-full">
            Request password reset
        </button>

        @slot("footerLink")
            Already have an account? -
            <a href="{{ route('login') }}"> Click here to login </a>
        @endslot
    </form>

</x-guest-layout>
