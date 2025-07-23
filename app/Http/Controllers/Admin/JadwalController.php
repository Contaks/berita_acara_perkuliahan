<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Models\JadwalKuliah;
use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;


class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = JadwalKuliah::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_mk', 'like', "%{$search}%")
                    ->orWhere('kelas', 'like', "%{$search}%")
                    ->orWhere('hari', 'like', "%{$search}%");
            });
        }

        $jadwals = $query->orderBy('hari')->orderBy('waktu')->paginate(10);

        return view('admin.jadwal.index', compact('jadwals'));
    }


    public function create()
    {
        $dosens = Dosen::all(); // ambil semua dosen
        return view('admin.jadwal.create', compact('dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:20',
            'nama_mk' => 'required|string|max:100',
            'sks' => 'required|integer|min:1',
            'nama_dosen' => 'required|string|max:100',
            'kelas' => 'required|string|max:10',
            'jumlah_mhs' => 'required|integer|min:1',
            'hari' => 'required|string|max:20',
            'waktu' => 'required|string|max:50',
            'ruang' => 'required|string|max:20',
            'kelompok' => 'nullable|string|max:20',
            'fakultas' => 'required|string|max:100',
            'prodi' => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:20',
            'semester' => 'required|string|max:10',
        ]);

        JadwalKuliah::create($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal = JadwalKuliah::findOrFail($id);
        $dosens = Dosen::all(); // atau sesuaikan dengan sumber datanya
        return view('admin.jadwal.edit', compact('jadwal', 'dosens'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'sks' => 'required|integer',
            'nama_dosen' => 'required',
            'kelas' => 'required',
            'jumlah_mhs' => 'required|integer',
            'hari' => 'required',
            'waktu' => 'required',
            'ruang' => 'required',
            'kelompok' => 'nullable',
            'fakultas' => 'required',
            'prodi' => 'required',
            'tahun_ajaran' => 'required',
            'semester' => 'required',
        ]);

        $jadwal = JadwalKuliah::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Data jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalKuliah::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Data jadwal berhasil dihapus.');
    }

    public function show($id)
    {
        $jadwal = JadwalKuliah::findOrFail($id);
        $mahasiswa = \App\Models\Mahasiswa::where('kelas', $jadwal->kelas)->get();

        return view('admin.jadwal.show', compact('jadwal', 'mahasiswa'));
    }
}
