@extends('layouts.mahasiswa.app')

@section('title', '🧾 Daftar BAP Aktif')

@section('contents')
  <div class="container-fluid">

    @if ($baps->isEmpty())
      <div class="alert alert-info">Tidak ada BAP yang perlu ditandatangani saat ini.</div>
    @else
      <table class="table-bordered table">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Mata Kuliah</th>
            <th>Tanggal</th>
            <th>Materi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($baps as $index => $bap)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $bap->jadwal->nama_mk ?? '-' }}</td>
              <td>{{ \Carbon\Carbon::parse($bap->tanggal)->format('d M Y') }}</td>
              <td>{{ $bap->materi }}</td>
              <td>
                <a href="{{ route('mahasiswa.bap.show', $bap->id) }}" class="btn btn-primary btn-sm">Lihat</a>
                <a href="{{ route('mahasiswa.bap.ttd', $bap->id) }}" class="btn btn-success btn-sm">TTD</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
@endsection
