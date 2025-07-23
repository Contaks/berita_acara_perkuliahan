<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Bap;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    // 📊 Laporan daftar dosen dengan jumlah BAP
    public function indexDosen()
    {
        $dosens = Dosen::withCount('bap')->get();
        return view('admin.reports.dosen.index', compact('dosens'));
    }

    // 📄 Detail BAP per dosen
    public function showDosen($id)
    {
        $dosen = Dosen::findOrFail($id);

        // Ambil BAP grup berdasarkan mata kuliah (jadwal_id)
        $groupedBap = $dosen->bap()
            ->with('jadwal')
            ->get()
            ->groupBy(fn($bap) => $bap->jadwal->nama_mk ?? 'Tidak Diketahui');

        return view('admin.reports.dosen.show', compact('dosen', 'groupedBap'));
    }


    // 📊 Laporan semua BAP (global)
    public function indexBap()
    {
        $baps = Bap::with(['dosen', 'jadwal'])->latest()->get();
        return view('admin.reports.bap.index', compact('baps'));
    }

    // 🧾 Export daftar dosen ke PDF
    public function exportIndexPdf()
    {
        $dosens = Dosen::withCount('bap')->get();
        return Pdf::loadView('admin.reports.dosen.export_index_pdf', compact('dosens'))
            ->download('laporan_bap_per_dosen.pdf');
    }

    // 🧾 Export detail BAP per dosen ke PDF
    public function exportShowPdf($id)
    {
        $dosen = Dosen::with(['bap.jadwal'])->findOrFail($id);
        $baps = $dosen->bap;

        return Pdf::loadView('admin.reports.dosen.export_dosen_pdf', compact('dosen', 'baps'))
            ->download('detail_bap_' . Str::slug($dosen->nama) . '.pdf');
    }

    // 🧾 Export semua BAP (global) ke PDF
    public function exportBapAll()
    {
        $baps = Bap::with(['dosen', 'jadwal'])->get();
        return Pdf::loadView('admin.reports.bap.export', compact('baps'))
            ->download('laporan-semua-bap.pdf');
    }
}
