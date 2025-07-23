@extends('layouts.mahasiswa.app')

@section('title', '📅 Jadwal Kuliah Saya')

@section('contents')
  <div class="container-fluid">

    <table class="table-bordered table-striped table">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Mata Kuliah</th>
          <th>Hari</th>
          <th>Waktu</th>
          <th>Ruang</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($jadwals as $index => $jadwal)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $jadwal->nama_mk }}</td>
            <td>{{ $jadwal->hari }}</td>
            <td>{{ $jadwal->waktu }}</td>
            <td>{{ $jadwal->ruang }}</td>
            <td>
              <a href="{{ route('mahasiswa.jadwal.show', $jadwal->id) }}" class="btn btn-info btn-sm">Detail</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
