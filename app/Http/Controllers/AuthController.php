<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'nohp'     => 'required|string|max:15',
            'role'     => 'required|in:petugas,pengunjung',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'nohp'     => $request->nohp,
            'role'     => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->with('error', 'Email atau password salah!');
        }

        $request->session()->regenerate();

        // Redirect sesuai role
        if (Auth::user()->role === 'petugas') {
            return redirect()->route('dashboard.petugas');
        }
        return redirect()->route('dashboard.pengunjung');
    }

    public function Index()
    {
        return view('index');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function dashboardPengunjung()
    {
        if (Auth::user()->role !== 'pengunjung') {
            abort(403, 'Anda tidak punya akses.');
        }
        return view('dashboard_pengunjung');
    }
}
