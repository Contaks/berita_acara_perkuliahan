<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Admin;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index', [
            'dosens' => Dosen::all(),
            'mahasiswas' => Mahasiswa::all(),
            'admins' => Admin::all(),
        ]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|in:admin,dosen,mahasiswa',
            'nama' => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $model = match ($request->role) {
            'admin' => new Admin(),
            'dosen' => new Dosen(),
            'mahasiswa' => new Mahasiswa(),
        };

        $model->nama = $request->nama;
        $model->password = bcrypt($request->password);
        $model->save();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show($tipe, $id)
    {
        $user = $this->findUser($tipe, $id);
        return view('admin.user.show', compact('user', 'tipe'));
    }

    public function edit($tipe, $id)
    {
        $user = $this->findUser($tipe, $id);
        return view('admin.user.edit', compact('user', 'tipe'));
    }

    public function update(Request $request, $tipe, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = $this->findUser($tipe, $id);
        $user->nama = $request->nama;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($tipe, $id)
    {
        $user = $this->findUser($tipe, $id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
    }

    /**
     * Helper untuk mencari user berdasarkan tipe dan ID
     */
    private function findUser($tipe, $id)
    {
        return match ($tipe) {
            'admin' => Admin::findOrFail($id),
            'dosen' => Dosen::findOrFail($id),
            'mahasiswa' => Mahasiswa::findOrFail($id),
            default => abort(404),
        };
    }
}
