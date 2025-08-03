@extends('layouts.app')

@section('title', 'Jadwal Mengajar')

@section('contents')
  <div class="container-fluid mt-4">
    <h3 class="mb-4">📅 Jadwal Mengajar</h3>

    @if ($jadwals->isEmpty())
      <div class="alert alert-info">Belum ada jadwal mengajar.</div>
    @else
      <div class="table-responsive">
        <table class="table-bordered table-hover table">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Kode MK</th>
              <th>Mata Kuliah</th>
              <th>Kelas</th>
              <th>Hari</th>
              <th>Waktu</th>
              <th>Ruang</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($jadwals as $index => $jadwal)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $jadwal->kode_mk }}</td>
                <td>{{ $jadwal->nama_mk }}</td>
                <td>{{ $jadwal->kelas }}</td>
                <td>{{ $jadwal->hari }}</td>
                <td>{{ $jadwal->waktu }}</td>
                <td>{{ $jadwal->ruang }}</td>
                <td>
                  <a href="{{ route('dosen.jadwal.show', $jadwal->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
