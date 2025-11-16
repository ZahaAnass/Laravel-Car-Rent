<x-guest-layout title="Signup" bodyClass="page-signup">
    <h1 class="auth-page-title">Signup</h1>

    <form action="" method="post">
        <div class="form-group">
            <input type="email" placeholder="Your Email" name="email" />
        </div>
        <div class="form-group">
            <input type="password" placeholder="Your Password" name="password" />
        </div>
        <div class="form-group">
            <input type="password" placeholder="Repeat Password" name="confirmPassword"/>
        </div>
        <hr />
        <div class="form-group">
            <input type="text" placeholder="First Name" name="first_name" />
        </div>
        <div class="form-group">
            <input type="text" placeholder="Last Name" name="last_name"/>
        </div>
        <div class="form-group">
            <input type="text" placeholder="Phone" name="phone"/>
        </div>
        <button class="btn btn-primary btn-login w-full">Register</button>
    </form>

    @slot("footerLink")
        Already have an account? -
        <a href="/login"> Click here to login </a>
    @endslot

</x-guest-layout>
