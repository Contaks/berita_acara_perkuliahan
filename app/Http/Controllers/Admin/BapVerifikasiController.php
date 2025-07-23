<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bap;
use App\Helpers\GeoHelper;
use Barryvdh\DomPDF\Facade\Pdf;
class BapVerifikasiController extends Controller
{
    public function index()
    {
        $baps = Bap::with('jadwal', 'dosen')->latest()->get();
        return view('admin.bap.index', compact('baps'));
    }

    public function show($id)
    {
        $bap = Bap::with('jadwal', 'dosen', 'bapMahasiswa.mahasiswa')->findOrFail($id);

        // Konversi lokasi mahasiswa
        foreach ($bap->bapMahasiswa as $bm) {
            if ($bm->lokasi_mahasiswa) {
                [$lat, $lon] = explode(',', $bm->lokasi_mahasiswa);
                $bm->lokasi_nama = GeoHelper::getCityFromCoordinates(trim($lat), trim($lon));
            } else {
                $bm->lokasi_nama = 'Tidak tersedia';
            }
        }

        // Konversi lokasi dosen
        if ($bap->lokasi_dosen) {
            [$latDosen, $lonDosen] = explode(',', $bap->lokasi_dosen);
            $bap->lokasi_dosen_nama = GeoHelper::getCityFromCoordinates(trim($latDosen), trim($lonDosen));
        } else {
            $bap->lokasi_dosen_nama = 'Tidak tersedia';
        }

        return view('admin.bap.show', compact('bap'));
    }


    public function verifikasi(Request $request, $id)
    {
        $bap = Bap::findOrFail($id);
        $bap->status_verifikasi = 'disetujui'; // ganti sesuai field di DB
        $bap->verifikasi_admin_id = auth()->id(); // simpan ID admin yg menyetujui
        $bap->save();

        return redirect()->route('admin.bap.index')->with('success', 'BAP berhasil diverifikasi.');
    }

    public function exportPdf($id)
    {
        $bap = Bap::with('jadwal', 'dosen', 'bapMahasiswa.mahasiswa')->findOrFail($id);

        // Lokasi Mahasiswa
        foreach ($bap->bapMahasiswa as $bm) {
            if ($bm->lokasi_mahasiswa) {
                [$lat, $lon] = explode(',', $bm->lokasi_mahasiswa);
                $bm->lokasi_nama = \App\Helpers\GeoHelper::getCityFromCoordinates(trim($lat), trim($lon));
            } else {
                $bm->lokasi_nama = 'Tidak tersedia';
            }
        }

        // Lokasi Dosen
        if ($bap->lokasi_dosen) {
            [$latDosen, $lonDosen] = explode(',', $bap->lokasi_dosen);
            $bap->lokasi_dosen_nama = \App\Helpers\GeoHelper::getCityFromCoordinates(trim($latDosen), trim($lonDosen));
        } else {
            $bap->lokasi_dosen_nama = 'Tidak tersedia';
        }

        $pdf = Pdf::loadView('admin.bap.pdf', compact('bap'))->setPaper('a4', 'portrait');
        return $pdf->stream('BAP-' . $bap->jadwal->nama_mk . '.pdf');
    }
}