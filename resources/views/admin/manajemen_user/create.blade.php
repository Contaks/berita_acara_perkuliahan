@extends('layouts.admin.app')

@section('title', 'Tambah User')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5>Tambah User</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.manajemen_user.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                required>
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">No. Telepon</label>
              <input type="text" class="form-control" id="phone" name="phone">
            </div>

            <div class="mb-3">
              <label for="nik" class="form-label">NIK</label>
              <input type="text" class="form-control" id="nik" name="nik">
            </div>

            <div class="mb-3">
              <label for="nim" class="form-label">NIM</label>
              <input type="text" class="form-control" id="nim" name="nim">
            </div>

            <div class="mb-3">
              <label for="class" class="form-label">Kelas</label>
              <input type="text" class="form-control" id="class" name="class">
            </div>

            <div class="mb-3">
              <label for="role" class="form-label">Role</label>
              <select class="form-control" id="role" name="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="dosen">Dosen</option>
                <option value="mahasiswa">Mahasiswa</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.manajemen_user.index') }}" class="btn btn-secondary">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
