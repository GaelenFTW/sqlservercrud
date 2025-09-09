<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Show Register Page
    public function showRegister()
    {
        return view('auth.register');
    }

    // Register User via SP
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        try {
            DB::statement("EXEC sp_register_user ?, ?, ?", [
                $request->name,
                $request->email,
                Hash::make($request->password)
            ]);

            return redirect()->route('login')->with('success', 'Registration successful. Please login.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Email already exists.']);
        }
    }

    // Show Login Page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login User via SP
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = DB::select("EXEC sp_login_user ?", [$request->email]);

        if ($user && Hash::check($request->password, $user[0]->password)) {
            Session::put('user', $user[0]);
            return redirect()->route('karyawan.index');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout
    public function logout()
    {
        Session::forget('user');
        return redirect()->route('login');
    }
}
