<x-guest-layout title="Reset Password" bodyClass="page-signup">
    <h2>Reset Your Password</h2>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <input type="password" name="password" placeholder="New Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

        <button class="btn btn-primary btn-login w-full" style="margin-top: 10px">
            Reset Password
        </button>

        @slot("footerLink")
            Remembered your password? -
            <a href="{{ route('login') }}"> Click here to login </a>
        @endslot

    </form>

</x-guest-layout>
