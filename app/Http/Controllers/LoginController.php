<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create() {
        return view("auth.login");
    }

    public function passwordReset()
    {
        return view("auth.password-reset");
    }

    public function destroy()
    {
        return redirect("/");
    }
}
