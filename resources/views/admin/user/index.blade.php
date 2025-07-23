@extends('layouts.admin.app')

@section('title', 'Manajemen User')

@section('contents')
<div class="container-fluid">
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4"><i class="fas fa-users-cog mr-1"></i> Manajemen User</h1>
    <a href="{{ route('admin.user.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Tambah User</a>
  </div>

  <div class="row">
    <div class="col-md-12">

      {{-- Admin Section --}}
      <h5 class="text-dark mt-4"><i class="fas fa-user-shield mr-1 text-primary"></i> Admin</h5>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="thead-light">
            <tr>
              <th>Nama</th>
              <th style="width: 200px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($admins as $admin)
              <tr>
                <td>{{ $admin->nama }}</td>
                <td>
                  <a href="{{ route('admin.user.show', ['admin', $admin->id]) }}" class="btn btn-info btn-sm" title="Lihat"><i class="fas fa-eye"></i></a>
                  <a href="{{ route('admin.user.edit', ['admin', $admin->id]) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                  <form action="{{ route('admin.user.destroy', ['admin', $admin->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{-- Dosen Section --}}
      <h5 class="text-dark mt-5"><i class="fas fa-chalkboard-teacher mr-1 text-success"></i> Dosen</h5>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="thead-light">
            <tr>
              <th>Nama</th>
              <th>NIDN</th>
              <th style="width: 200px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dosens as $dosen)
              <tr>
                <td>{{ $dosen->nama }}</td>
                <td>{{ $dosen->nidn }}</td>
                <td>
                  <a href="{{ route('admin.user.show', ['dosen', $dosen->id]) }}" class="btn btn-info btn-sm" title="Lihat"><i class="fas fa-eye"></i></a>
                  <a href="{{ route('admin.user.edit', ['dosen', $dosen->id]) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                  <form action="{{ route('admin.user.destroy', ['dosen', $dosen->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{-- Mahasiswa Section --}}
      <h5 class="text-dark mt-5"><i class="fas fa-user-graduate mr-1 text-warning"></i> Mahasiswa</h5>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="thead-light">
            <tr>
              <th>Nama</th>
              <th>NIM</th>
              <th style="width: 200px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($mahasiswas as $mahasiswa)
              <tr>
                <td>{{ $mahasiswa->nama }}</td>
                <td>{{ $mahasiswa->nim }}</td>
                <td>
                  <a href="{{ route('admin.user.show', ['mahasiswa', $mahasiswa->id]) }}" class="btn btn-info btn-sm" title="Lihat"><i class="fas fa-eye"></i></a>
                  <a href="{{ route('admin.user.edit', ['mahasiswa', $mahasiswa->id]) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                  <form action="{{ route('admin.user.destroy', ['mahasiswa', $mahasiswa->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
