@extends('layouts.admin.app')

@section('contents')
  <div class="container-fluid">
    <div class="card shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-chalkboard-teacher me-2"></i> Laporan BAP per Dosen</h5>
        <a href="{{ route('admin.reports.dosen.exportIndexPdf') }}" class="btn btn-danger btn-sm">
          <i class="fas fa-file-pdf me-1"></i> Export PDF
        </a>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table-bordered table-hover table align-middle">
            <thead class="table-primary text-center">
              <tr>
                <th style="width: 40%;">Nama Dosen</th>
                <th style="width: 20%;">Jumlah BAP Dibuat</th>
                <th style="width: 20%;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($dosens as $dosen)
                <tr>
                  <td>{{ $dosen->nama }}</td>
                  <td class="text-center">{{ $dosen->bap_count }}</td>
                  <td class="text-center">
                    <a href="{{ route('admin.reports.dosen.show', $dosen->id) }}" class="btn btn-sm btn-primary">
                      <i class="fas fa-eye me-1"></i> Lihat Detail
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="text-muted text-center">Tidak ada data dosen.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
