@extends('layouts.app')

@section('contents')
  <div class="container-fluid">
    <h1 class="mb-4">📄 Laporan Detail BAP - {{ $jadwal->nama_mk }} ({{ $jadwal->kelas }})</h1>

    <a href="{{ route('dosen.reports.index') }}" class="btn btn-sm btn-secondary mb-3">← Kembali</a>
    <a href="{{ route('dosen.reports.pdf', $jadwal->id) }}" class="btn btn-sm btn-danger mb-3">⬇ Export PDF</a>

    <div class="card shadow">
      <div class="card-body">
        <table class="table-bordered table-striped table">
          <thead class="table-info text-center">
            <tr>
              <th>Pertemuan</th>
              <th>Tanggal</th>
              <th>Materi</th>
              <th>Kelas</th>
              <th>Jumlah Mahasiswa Hadir</th>
              <th>Lokasi</th>
              <th>TTD Dosen</th>
              <th>TTD Mahasiswa</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($baps as $bap)
              @php
                $jumlahHadir = $bap->bapMahasiswa->where('hadir', true)->count();
                $totalMhs = $bap->bapMahasiswa->count();
                $ttdDosen = $bap->foto_pembelajaran ? '✔️' : '❌';
                $ttdMahasiswa =
                    $bap->bapMahasiswa->where('ttd_mahasiswa', '!=', null)->count() === $totalMhs ? '✔️' : '❌';
                $status = $ttdDosen == '✔️' && $ttdMahasiswa == '✔️' ? 'Lengkap' : 'Belum Lengkap';
              @endphp
              <tr class="text-center">
                <td>{{ $bap->pertemuan_ke }}</td>
                <td>{{ \Carbon\Carbon::parse($bap->tanggal)->format('d-m-Y') }}</td>
                <td class="text-start">{{ $bap->materi }}</td>
                <td>{{ $jadwal->kelas }}</td>
                <td>{{ $jumlahHadir }}</td>
                <td>{{ $bap->lokasi_dosen }}</td>
                <td>{{ $ttdDosen }}</td>
                <td>{{ $ttdMahasiswa }}</td>
                <td>
                  @if ($status == 'Lengkap')
                    <span class="badge bg-success">Lengkap</span>
                  @else
                    <span class="badge bg-warning text-dark">Belum Lengkap</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9" class="text-center">Belum ada data BAP yang diinput.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
