@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5>Edit User</h5>
        </div>
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('admin.manajemen_user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">No. Telepon</label>
              <input type="text" class="form-control" id="phone" name="phone"
                value="{{ old('phone', $user->phone) }}">
            </div>

            <div class="mb-3">
              <label for="nik" class="form-label">NIK</label>
              <input type="text" class="form-control" id="nik" name="nik"
                value="{{ old('nik', $user->nik) }}">
            </div>

            <div class="mb-3">
              <label for="nim" class="form-label">NIM</label>
              <input type="text" class="form-control" id="nim" name="nim"
                value="{{ old('nim', $user->nim) }}">
            </div>

            <div class="mb-3">
              <label for="class" class="form-label">Kelas</label>
              <input type="text" class="form-control" id="class" name="class"
                value="{{ old('class', $user->class) }}">
            </div>

            <div class="mb-3">
              <label for="role" class="form-label">Role</label>
              <select class="form-control" id="role" name="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="dosen" {{ old('role', $user->role) === 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="mahasiswa" {{ old('role', $user->role) === 'mahasiswa' ? 'selected' : '' }}>Mahasiswa
                </option>
              </select>
            </div>

            <div class="d-flex justify-content-between">
              <a href="{{ route('admin.manajemen_user.index') }}" class="btn btn-secondary">Kembali</a>
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
