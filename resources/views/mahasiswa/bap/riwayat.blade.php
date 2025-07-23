@extends('layouts.mahasiswa.app')
@section('title', 'Riwayat Tanda Tangan BAP')

@section('contents')
  <div class="container-fluid">

    <table class="table-bordered table">
      <thead>
        <tr>
          <th>#</th>
          <th>Mata Kuliah</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Aksi</th> {{-- Tambahan --}}
        </tr>
      </thead>
      <tbody>
        @forelse ($riwayat as $ttd)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $ttd->bap->jadwal->nama_mk ?? '-' }}</td>
            <td>{{ $ttd->bap->tanggal }}</td>
            <td>{{ $ttd->ttd_mahasiswa ? 'Sudah TTD' : 'Belum TTD' }}</td>
            <td>
              <a href="{{ route('mahasiswa.bap.show', $ttd->bap_id) }}" class="btn btn-info btn-sm">Lihat</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center">Belum ada riwayat tanda tangan.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

  </div>
@endsection
