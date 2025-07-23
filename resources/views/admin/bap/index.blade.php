@extends('layouts.admin.app')

@section('title', 'Daftar Verifikasi BAP')

@section('contents')
  <div class="container-fluid">
    <h4 class="mb-3"><i class="fas fa-file-signature"></i> Daftar Verifikasi BAP Dosen</h4>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table-bordered table-striped table">
            <thead class="table-light">
              <tr>
                <th>Hari</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th style="white-space: nowrap;">Waktu</th>
                <th>Status</th>
                <th>Dibuat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($baps as $bap)
                <tr>
                  <td>{{ $bap->jadwal->hari ?? '-' }}</td>
                  <td>{{ $bap->jadwal->nama_mk ?? '-' }}</td>
                  <td>{{ $bap->dosen->nama ?? '-' }}</td>
                  <td style="white-space: nowrap;">{{ $bap->jadwal->waktu ?? '-' }}</td>
                  <td>
                    @php
                      $status = $bap->status_verifikasi ?? 'belum';
                      $badgeClass = match ($status) {
                          'disetujui' => 'bg-success',
                          'ditolak' => 'bg-danger',
                          default => 'bg-warning text-dark',
                      };
                    @endphp
                    <span class="badge {{ $badgeClass }}">
                      {{ ucfirst($status) }}
                    </span>
                  </td>
                  <td>{{ $bap->created_at ?? '-' }}</td>
                  <td>
                    <a href="{{ route('admin.bap.show', $bap->id) }}" class="btn btn-sm btn-primary">
                      <i class="fas fa-eye"></i> Detail
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center">Belum ada data BAP</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
