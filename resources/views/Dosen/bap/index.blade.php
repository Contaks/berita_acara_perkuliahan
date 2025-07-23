@extends('layouts.app')

@section('title', 'Manajemen BAP')

@section('contents')
  <div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="mb-0">📄Berita Acara Perkuliahan</h3>
      <a href="{{ route('dosen.bap.create') }}" class="btn btn-primary">
        + Buat BAP
      </a>
    </div>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <div class="card">
      <div class="card-body">
        @if ($baps->isEmpty())
          <p class="text-muted">Belum ada BAP yang dibuat.</p>
        @else
          <div class="table-responsive">
            <table class="table-bordered table-hover table">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Mata Kuliah</th>
                  <th>Tanggal</th>
                  <th>Pertemuan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($baps as $bap)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $bap->jadwal->nama_mk ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($bap->tanggal)->format('d M Y') }}</td>
                    <td>{{ $bap->pertemuan_ke ?? '-' }}</td>
                    <td><span class="badge bg-info text-dark">{{ ucfirst($bap->status ?? 'draft') }}</span></td>
                    <td>
                      <a href="{{ route('dosen.bap.show', $bap->id) }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection
