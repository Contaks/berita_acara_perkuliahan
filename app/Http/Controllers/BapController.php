<?php

namespace App\Http\Controllers;

use App\Models\Bap;
use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class BapController extends Controller
{
    public function index()
    {
        $baps = Bap::with('jadwal.mataKuliah')->get();
        return view('bap.index', compact('baps'));
    }

    public function create()
    {
        $jadwals = Jadwal::with('mataKuliah')->get();
        return view('bap.create', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'tanggal' => 'required|date',
            'materi' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Bap::create([
            'jadwal_id' => $request->jadwal_id,
            'tanggal' => $request->tanggal,
            'materi' => $request->materi,
            'keterangan' => $request->keterangan,
            'created_by' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('bap.index')->with('success', 'BAP berhasil ditambahkan.');
    }


    public function show($id)
    {
        $bap = Bap::with('jadwal.mataKuliah')->findOrFail($id);
        return view('bap.show', compact('bap'));
    }

    public function edit($id)
    {
        $bap = Bap::findOrFail($id);
        $jadwals = Jadwal::with('mataKuliah')->get();
        return view('bap.edit', compact('bap', 'jadwals'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'tanggal' => 'required|date',
            'materi' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $bap = Bap::findOrFail($id);
        $bap->update($request->all());

        return redirect()->route('bap.index')->with('success', 'BAP berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bap = Bap::findOrFail($id);
        $bap->delete();

        return redirect()->route('bap.index')->with('success', 'BAP berhasil dihapus.');
    }
    public function adminIndex()
    {
        $baps = Bap::with('jadwal.mataKuliah')->where('status', 'pending')->get();
        return view('admin.bap.index', compact('baps'));
    }

    public function approve($id)
    {
        $bap = Bap::findOrFail($id);
        $bap->update(['status' => 'approved']);

        return redirect()->route('admin.bap.index')->with('success', 'BAP telah disetujui.');
    }

    public function reject($id)
    {
        $bap = Bap::findOrFail($id);
        $bap->update(['status' => 'rejected']);

        return redirect()->route('admin.bap.index')->with('success', 'BAP telah ditolak.');
    }

    public function adminShow($id)
    {
        $bap = Bap::with(['jadwal.mataKuliah', 'feedbacks'])->findOrFail($id);
        return view('admin.bap.show', compact('bap'));
    }

    public function approvedBaps()
    {
        $baps = Bap::with('jadwal.mataKuliah')->where('status', 'approved')->get();
        return view('admin.bap.approved', compact('baps'));
    }

    public function mahasiswaIndex()
    {
        // Ambil mahasiswa yang sedang login
        $mahasiswa = auth()->user();

        // Ambil jadwal yang memiliki kelas sama dengan class mahasiswa
        $jadwalMahasiswa = Jadwal::where('kelas', $mahasiswa->class)->pluck('id');

        // Ambil BAP yang memiliki jadwal yang sesuai dengan mahasiswa
        $baps = Bap::with('jadwal.mataKuliah')
            ->whereIn('jadwal_id', $jadwalMahasiswa)
            ->get();

        return view('mahasiswa.bap.index', compact('baps'));
    }



    public function mahasiswaShow($id)
    {
        $bap = Bap::with(['jadwal.mataKuliah', 'feedbacks'])->findOrFail($id);
        $mahasiswa = auth()->user();

        return view('mahasiswa.bap.show', compact('bap', 'mahasiswa'));
    }
}