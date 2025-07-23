@extends('layouts.app')

@section('contents')
  <div class="container-fluid">
    <h1 class="mb-4">📄 Laporan BAP Perkuliahan</h1>
    <div class="card shadow">
      <div class="card-body">
        <table class="table-bordered table-striped table">
          <thead class="table-primary">
            <tr class="text-center">
              <th>No</th>
              <th>Mata Kuliah</th>
              <th>Hari</th>
              <th>Waktu</th>
              <th>Kelas</th>
              <th>Jumlah Pertemuan</th>
              <th>BAP Terisi</th>
              <th>Persentase</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($jadwals as $i => $jadwal)
              @php
                $total = $jadwal->total_pertemuan ?? 16;
                $bapCount = $jadwal->baps->count();
                $percent = $total > 0 ? round(($bapCount / $total) * 100, 1) : 0;
              @endphp
              <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $jadwal->nama_mk }}</td>
                <td>{{ $jadwal->hari }}</td>
                <td>{{ $jadwal->waktu }}</td>
                <td class="text-center">{{ $jadwal->kelas }}</td>
                <td class="text-center">{{ $total }}</td>
                <td class="text-center">{{ $bapCount }}</td>
                <td class="text-center">{{ $percent }}%</td>
                <td class="text-center">
                  <a href="{{ route('dosen.reports.show', $jadwal->id) }}" class="btn btn-sm btn-primary">
                    📄 Lihat BAP
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9" class="text-center">Tidak ada data jadwal.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
