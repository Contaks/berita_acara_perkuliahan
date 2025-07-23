@extends('layouts.admin.app')

@section('contents')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">📄 Detail Berita Acara Perkuliahan - {{ $dosen->nama }}</h4>
    <a href="{{ route('admin.reports.dosen.exportShowPdf', $dosen->id) }}" class="btn btn-danger btn-sm">
      <i class="fas fa-file-pdf"></i> Export PDF
    </a>
  </div>

  <div class="card">
    <div class="card-body">
      <table class="table-bordered table-striped table">
        <thead class="table-light">
          <tr>
            <th>Mata Kuliah</th>
            <th>Jumlah BAP</th>
            <th>Disetujui</th>
            <th>Belum</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($groupedBap as $jadwalId => $baps)
            @php
              $namaMk = $baps->first()->jadwal->nama_mk ?? '-';
              $total = $baps->count();
              $disetujui = $baps->where('status_verifikasi', 'disetujui')->count();
              $belum = $total - $disetujui;
            @endphp
            <tr>
              <td>{{ $namaMk }}</td>
              <td>{{ $total }}</td>
              <td>{{ $disetujui }}</td>
              <td>{{ $belum }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center">Tidak ada data BAP</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <a href="{{ route('admin.reports.dosen.index') }}" class="btn btn-secondary btn-sm mt-3">
    <i class="fas fa-arrow-left"></i> Kembali
  </a>
@endsection
