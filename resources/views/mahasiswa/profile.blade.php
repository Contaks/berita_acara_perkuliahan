@extends('layouts.mahasiswa.app')

@section('title', 'Profile')

@section('contents')
  <h1 class="mb-0">Profile</h1>
  <hr />

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form method="POST" enctype="multipart/form-data" action="{{ route('mahasiswa.profile.update') }}">
    @csrf
    <div class="row">
      <div class="col-md-12 border-right">
        <div class="p-3 py-5">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Profile Settings Mahasiswa</h4>
          </div>
          <div class="row" id="res"></div>

          <div class="row mt-2">
            <div class="col-md-6">
              <label class="labels">Name</label>
              <input type="text" name="name" class="form-control" placeholder="First Name"
                value="{{ old('name', auth()->user()->name) }}">
            </div>
            <div class="col-md-6">
              <label class="labels">Email</label>
              <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled>
            </div>
          </div>

          <div class="row mt-2">
            <div class="col-md-6">
              <label class="labels">Class</label>
              <input type="text" name="class" class="form-control" value="{{ old('class', auth()->user()->class) }}"
                placeholder="Contoh: 7D-KOM">
            </div>
            <div class="col-md-6">
              <label class="labels">Phone</label>
              <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                value="{{ old('phone', auth()->user()->phone) }}">
            </div>
          </div>

          {{-- <div class="row mt-2">
            <div class="col-md-6">
              <label class="labels">Address</label>
              <input type="text" name="address" class="form-control"
                value="{{ old('address', auth()->user()->address) }}" placeholder="Address">
            </div>
          </div> --}}

          <div class="mt-5 text-center">
            <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection
