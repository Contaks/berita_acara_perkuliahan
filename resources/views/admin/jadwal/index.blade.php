@extends('layouts.admin.app')

@section('title', 'Manajemen Jadwal')

@section('contents')
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3>📅 Manajemen Jadwal Perkuliahan</h3>
      <div>
        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-success btn-sm">
          <i class="fas fa-plus"></i> Tambah Jadwal
        </a>
        <a href="{{ route('admin.jadwal.import.form') }}" class="btn btn-primary btn-sm">
          <i class="fas fa-upload"></i> Upload Jadwal (Excel)
        </a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table-bordered table-striped table-hover table">
        <thead class="thead-dark">
          <tr class="text-center">
            <th>No</th>
            <th>Kode MK</th>
            <th>Mata Kuliah</th>
            <th>Dosen</th>
            <th>Kelas</th>
            <th>Hari</th>
            <th>Waktu</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($jadwals as $item)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td>{{ $item->kode_mk }}</td>
              <td>{{ $item->nama_mk }}</td>
              <td>{{ $item->nama_dosen }}</td>
              <td>{{ $item->kelas }}</td>
              <td>{{ $item->hari }}</td>
              <td>{{ $item->waktu }}</td>
              <td class="text-center">
                <a href="{{ route('admin.jadwal.show', $item->id) }}" class="btn btn-info btn-sm mb-1">
                  <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('admin.jadwal.edit', $item->id) }}" class="btn btn-warning btn-sm mb-1">
                  <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.jadwal.destroy', $item->id) }}" method="POST"
                  style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-muted text-center">Belum ada data jadwal perkuliahan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
