<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view("register");
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new Admin();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);

        $user->save();

        return view('login');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password', 'email');

        $user = Admin::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            return redirect("dashboard");
        } else {
            return redirect()->back();
        }
    }

    public function dashboard()
    {
        return view("dashboard");
    }
}
