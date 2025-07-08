@extends('layouts.mahasiswa.app')

@section('title', 'Form Feedback Mahasiswa')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5>Form Feedback</h5>
          <p class="text-muted">Silakan isi feedback untuk BAP ini. Maksimal 2 mahasiswa dapat memberikan feedback.</p>
        </div>
        <div class="card-body">

          {{-- Menampilkan pesan sukses atau error --}}
          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endif

          {{-- Menampilkan error validasi --}}
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {{-- Form Feedback --}}
          <form action="{{ route('mahasiswa.feedback.store') }}" method="POST">
            @csrf
            <input type="hidden" name="bap_id" value="{{ $bap->id }}" />

            <div class="form-group">
              <label for="nama_mahasiswa">Nama Mahasiswa</label>
              <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control"
                value="{{ $mahasiswa->name }}" readonly>
            </div>

            <div class="form-group">
              <label for="nim">NIM</label>
              <input type="text" name="nim" id="nim" class="form-control" value="{{ $mahasiswa->nim }}"
                readonly>
            </div>

            <div class="form-group">
              <label for="kelas">Kelas</label>
              <input type="text" name="kelas" id="kelas" class="form-control" value="{{ $mahasiswa->class }}"
                readonly>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="{{ $mahasiswa->email }}"
                readonly>
            </div>

            <div class="form-group">
              <label for="feedback">Feedback</label>
              <textarea name="feedback" id="feedback" rows="4" class="form-control"
                placeholder="Tulis feedback Anda di sini..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Kirim Feedback</button>
          </form>

        </div>
      </div>
    </div>
  </div>
@endsection
