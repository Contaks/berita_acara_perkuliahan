@extends('layouts.admin.app')

@section('title', 'Detail User')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5>Detail User</h5>
        </div>
        <div class="card-body">
          <p><strong>Nama:</strong> {{ $user->name }}</p>
          <p><strong>Email:</strong> {{ $user->email }}</p>
          <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
          <p><strong>No. Telepon:</strong> {{ $user->phone ?? '-' }}</p>
          <p><strong>NIK:</strong> {{ $user->nik ?? '-' }}</p>
          <p><strong>NIM:</strong> {{ $user->nim ?? '-' }}</p>
          <p><strong>Kelas:</strong> {{ $user->class ?? '-' }}</p>

          <a href="{{ route('admin.manajemen_user.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
      </div>
    </div>
  </div>
@endsection
