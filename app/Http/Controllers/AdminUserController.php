<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(15);
        return view("admin.users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            "role" => "required|in:user,admin",
        ],[
            'role.in' => 'The selected role is invalid. Choose either user or admin.',
            'password.confirmed' => 'The password confirmation does not match.',
            'email.unique' => 'The email has already been taken.',
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;

        if($user->save()){
            return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
        }

        return redirect()->route('admin.users.index')->with('error', 'Failed to create user.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view("admin.users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view("admin.users.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            "role" => "required|in:user,admin",
            "phone" => "required|string|max:20",
        ],[
            'role.in' => 'The selected role is invalid. Choose either user or admin.',
            'email.unique' => 'The email has already been taken.',
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->phone = $request->phone;

        if($user->save()){
            return redirect()->route('admin.users.show', $user)->with('success', 'User updated successfully.');
        }
        return redirect()->route('admin.users.index')->with('error', 'Failed to update user.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->delete()){
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        }
        return redirect()->route('admin.users.index')->with('error', 'Failed to delete user.');
    }

    public function updatePassword()
    {

    }
}
