<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\JadwalKuliah;

class MahasiswaJadwalController extends Controller
{
    // Menampilkan daftar jadwal kuliah mahasiswa sesuai kelasnya
    public function index()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $jadwals = JadwalKuliah::where('kelas', $mahasiswa->kelas)->get();

        return view('mahasiswa.jadwal.index', compact('jadwals'));
    }

    // Menampilkan detail jadwal kuliah tertentu
    public function show($id)
    {
        $jadwal = JadwalKuliah::findOrFail($id);

        return view('mahasiswa.jadwal.show', compact('jadwal'));
    }
}
