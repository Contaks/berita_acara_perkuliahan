<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalKuliah;
use App\Models\Bap;
use Barryvdh\DomPDF\Facade\Pdf;

class DosenReportController extends Controller
{
    public function index()
    {
        $dosen = Auth::guard('dosen')->user();
        $jadwals = JadwalKuliah::withCount('baps')
            ->where('nama_dosen', $dosen->nama)
            ->get();

        return view('dosen.reports.index', compact('jadwals'));
    }

    public function show($jadwalId)
    {
        $jadwal = JadwalKuliah::findOrFail($jadwalId);
        $baps = Bap::with('bapMahasiswa') // penting agar tidak N+1
            ->where('jadwal_kuliah_id', $jadwal->id)
            ->orderBy('pertemuan_ke')
            ->get();

        return view('dosen.reports.show', compact('jadwal', 'baps'));
    }

    public function exportPdf($jadwalId)
    {
        $jadwal = JadwalKuliah::findOrFail($jadwalId);
        $baps = Bap::where('jadwal_kuliah_id', $jadwal->id)->orderBy('pertemuan_ke')->get();

        $pdf = Pdf::loadView('dosen.reports.pdf', compact('jadwal', 'baps'))->setPaper('a4', 'portrait');
        return $pdf->stream('laporan_bap_' . $jadwal->kode_mk . '.pdf');
    }
}
