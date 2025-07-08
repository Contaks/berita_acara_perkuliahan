<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register Page
    public function register()
    {
        return view('auth/register');
    }

    // Save User Registration
    public function registerSave(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Simpan data user ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => null,
            'location' => null,
            'about_me' => null,
            'role' => 'dosen',
        ]);

        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    // Login Page
    public function login()
    {
        return view('auth/login');
    }

    // Login Action
    public function loginAction(Request $request)
    {
        // Validasi input login
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Cek kredensial user
        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
            }

            if (Auth::user()->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard')->with('success', 'Welcome Mahasiswa!');
            }

            return redirect()->route('dashboard')->with('success', 'Welcome User!');
        }


        // Jika login gagal
        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        return redirect('/')->with('success', 'Logged out successfully.');
    }

    public function profile()
    {
        return view('profile'); // Pastikan file 'profile.blade.php' ada di dalam folder resources/views
    }

    public function profileMahasiswa()
    {
        return view('mahasiswa.profile');
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'class' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Simpan perubahan
        $user->update([
            'name' => $request->name,
            'class' => $request->class,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('mahasiswa.profile')->with('success', 'Profile updated successfully!');
    }




    public function apiLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password.',
            ], 401);
        }

        // ✅ Tambahkan ini untuk buat token Sanctum
        $token = $user->createToken('mobile_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful!',
            'data' => $user,
            'token' => $token, // kirim token ke Flutter
        ], 200);
    }
}
