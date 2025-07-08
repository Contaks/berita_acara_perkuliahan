@extends('layouts.admin.app')

@section('title', 'Data User')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5>Data Pengguna</h5>
          <a href="{{ route('admin.manajemen_user.create') }}" class="btn btn-primary btn-sm">Tambah User</a>
        </div>
        <div class="card-body">
          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          <table class="table-bordered table">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Telepon</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $user)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ ucfirst($user->role) }}</td>
                  <td>{{ $user->phone ?? '-' }}</td>
                  <td>
                    <a href="{{ route('admin.manajemen_user.show', $user->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('admin.manajemen_user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.manajemen_user.destroy', $user->id) }}" method="POST"
                      style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus user ini?')">Delete</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center">Tidak ada data user</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
