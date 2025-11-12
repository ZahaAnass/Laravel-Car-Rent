<x-guest-layout title="Signup" bodyClass="page-signup">

    <h1 class="auth-page-title">Request Password Reset</h1>

    <form action="" method="post">
        <div class="form-group">
            <input type="email" placeholder="Your Email" />
        </div>

        <button class="btn btn-primary btn-login w-full">
            Request password reset
        </button>

        @slot("footerLink")
            Already have an account? -
            <a href="/login"> Click here to login </a>
        @endslot
    </form>

</x-guest-layout>
