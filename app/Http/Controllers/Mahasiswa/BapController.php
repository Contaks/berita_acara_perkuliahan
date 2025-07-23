<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bap;
use App\Models\BapMahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;

class BapController extends Controller
{
    /**
     * Menampilkan daftar BAP yang aktif dan belum ditandatangani oleh mahasiswa.
     */
    public function index()
    {
        $mahasiswaId = Auth::guard('mahasiswa')->id();

        // Ambil semua BAP yang berkaitan dengan mahasiswa ini dan belum ditandatangani (lokasi_mahasiswa masih null)
        $baps = Bap::whereHas('bapMahasiswa', function ($query) use ($mahasiswaId) {
            $query->where('mahasiswa_id', $mahasiswaId)
                ->whereNull('lokasi_mahasiswa');
        })->with(['jadwal'])->latest()->get();

        return view('mahasiswa.bap.index', compact('baps'));
    }

    /**
     * Menampilkan detail BAP untuk mahasiswa.
     */
    public function show($id)
    {
        $mahasiswaId = Auth::guard('mahasiswa')->id();

        // Pastikan BAP memang terhubung dengan mahasiswa tersebut
        $bap = Bap::whereHas('bapMahasiswa', function ($query) use ($mahasiswaId) {
            $query->where('mahasiswa_id', $mahasiswaId);
        })->with(['jadwal', 'bapMahasiswa'])->findOrFail($id);

        return view('mahasiswa.bap.show', compact('bap'));
    }

    public function formTtd($id)
    {
        $mahasiswaId = Auth::guard('mahasiswa')->id();

        // Pastikan BAP memang terhubung dengan mahasiswa tersebut
        $bap = Bap::whereHas('bapMahasiswa', function ($query) use ($mahasiswaId) {
            $query->where('mahasiswa_id', $mahasiswaId);
        })->with('jadwal')->findOrFail($id);

        return view('mahasiswa.bap.ttd', compact('bap'));
    }


    /**
     * Proses mahasiswa tanda tangan BAP dengan menyimpan lokasi.
     */
    public function ttd(Request $request, $id)
    {
        $mahasiswaId = Auth::guard('mahasiswa')->id();

        $request->validate([
            'lokasi_mahasiswa' => 'required|string|max:255',
            'ttd_mahasiswa' => 'required|string',
        ]);

        // Cek apakah sudah ada 2 mahasiswa yang memberikan ttd pada BAP ini
        $jumlahSudahTtd = BapMahasiswa::where('bap_id', $id)
            ->whereNotNull('ttd_mahasiswa')
            ->count();

        if ($jumlahSudahTtd >= 2) {
            return redirect()->back()->with('error', 'Batas maksimal mahasiswa yang memberikan TTD telah tercapai.');
        }

        $bapMahasiswa = BapMahasiswa::where('bap_id', $id)
            ->where('mahasiswa_id', $mahasiswaId)
            ->firstOrFail();

        // Cegah mahasiswa memberikan ttd lebih dari sekali
        if ($bapMahasiswa->ttd_mahasiswa) {
            return redirect()->back()->with('error', 'Anda sudah memberikan TTD untuk BAP ini.');
        }

        $bapMahasiswa->update([
            'lokasi_mahasiswa' => $request->lokasi_mahasiswa,
            'ttd_mahasiswa' => $request->ttd_mahasiswa,
        ]);

        return redirect()->route('mahasiswa.bap.index')->with('success', 'Berhasil tanda tangan BAP.');
    }


    public function riwayat()
    {
        $mahasiswaId = Auth::guard('mahasiswa')->id();

        $riwayat = BapMahasiswa::where('mahasiswa_id', $mahasiswaId)
            ->whereNotNull('lokasi_mahasiswa')
            ->with(['bap.jadwal'])
            ->latest()
            ->get();

        return view('mahasiswa.bap.riwayat', compact('riwayat'));
    }

    public function exportPdf($id)
    {
        $bap = Bap::with(['jadwal', 'dosen', 'mahasiswa', 'bapMahasiswa'])->findOrFail($id);

        $pdf = Pdf::loadView('dosen.bap.pdf', compact('bap'))->setPaper('a4', 'portrait');
        return $pdf->stream('berita_acara_' . $bap->id . '.pdf');
    }
}
