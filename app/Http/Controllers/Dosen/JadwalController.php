<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalKuliah;
use App\Models\Mahasiswa;

class JadwalController extends Controller
{
    public function index()
    {
        $dosen = Auth::guard('dosen')->user();

        $jadwals = JadwalKuliah::where('nama_dosen', $dosen->nama)
            ->orderBy('hari')
            ->orderBy('waktu') // pakai 'waktu', bukan 'waktu_mulai'
            ->get();

        return view('dosen.jadwal.index', compact('jadwals'));
    }
    public function create($jadwal_id)
    {
        $jadwal = JadwalKuliah::findOrFail($jadwal_id);
        return view('dosen.bap.create', compact('jadwal'));
    }

    public function show($id)
    {
        $jadwal = JadwalKuliah::findOrFail($id);
        $mahasiswa = Mahasiswa::where('kelas', $jadwal->kelas)->get();

        return view('dosen.jadwal.show', compact('jadwal', 'mahasiswa'));
    }
}
