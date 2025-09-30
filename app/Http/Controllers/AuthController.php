<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'nohp'     => 'required|string|max:15',
            'role'     => 'required|in:petugas,pengunjung',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploaded_profiles'), $imageName);
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'nohp'     => $request->nohp,
            'role'     => $request->role,
            'image'    => $imageName,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Tampil profil
    public function showProfile()
    {
        $user = Auth::user();
        return view('profile_petugas', compact('user'));
    }

    // Update profil
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'nohp'  => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        // Update data dasar
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->nohp  = $request->nohp;

        // Update foto kalau ada
        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path('uploaded_profiles/' . $user->image))) {
                unlink(public_path('uploaded_profiles/' . $user->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploaded_profiles'), $imageName);
            $user->image = $imageName;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
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
