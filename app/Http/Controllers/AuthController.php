<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //register from
    public function showRegister()
    {
        return view('auth.register');
    }

    // process register
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'role' => 'required|in:merchant,customer'
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);

            return redirect('/login')->with('success', 'Registrasi Berhasil');
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => 'Registrasi Gagal'
            ]);
        }
    }

    //login form
    public function showLogin()
    {
        return view('auth.login');
    }

    //login proses
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            if (!Auth::attempt($credentials)) {
                return back()->withErrors([
                    'error' => "Email atau Password Salah"
                ]);
            }

            $request->session()->regenerate();
            $user = Auth::user();

            //redirect berdasarkan role 
            return match ($user->role) {
                'merchant' => redirect('/merchant'),
                'customer' => redirect('/customer')
            };
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => "Login gagal"
            ]);
        }
    }

    //logout
    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->with('success', 'Anda Telah Logout');
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => "Logout Gagal"
            ]);
        }
    }
}
