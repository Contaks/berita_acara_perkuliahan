<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManajemenUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.manajemen_user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.manajemen_user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone'    => 'nullable|string|max:20',
            'nik'      => 'nullable|string|max:20',
            'nim'      => 'nullable|string|max:20',
            'role'     => 'required|in:admin,dosen,mahasiswa',
            'class'    => 'nullable|string|max:50',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('admin.manajemen_user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.manajemen_user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.manajemen_user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'phone'    => 'nullable|string|max:20',
            'nik'      => 'nullable|string|max:20',
            'nim'      => 'nullable|string|max:20',
            'role'     => 'required|in:admin,dosen,mahasiswa',
            'class'    => 'nullable|string|max:50',
        ]);

        $data = $request->except(['password']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.manajemen_user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.manajemen_user.index')->with('success', 'User berhasil dihapus.');
    }
}
