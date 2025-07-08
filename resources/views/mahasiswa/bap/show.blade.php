@extends('layouts.mahasiswa.app')

@section('title', 'Detail BAP')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5>Detail Berita Acara Perkuliahan (BAP)</h5>
        </div>
        <div class="card-body">
          <table class="table-bordered table">
            <tr>
              <th>Tanggal</th>
              <td>{{ $bap->tanggal }}</td>
            </tr>
            <tr>
              <th>Mata Kuliah</th>
              <td>{{ $bap->jadwal->mataKuliah->nama }}</td>
            </tr>
            <tr>
              <th>Materi</th>
              <td>{{ $bap->materi }}</td>
            </tr>
            <tr>
              <th>Keterangan</th>
              <td>{{ $bap->keterangan }}</td>
            </tr>
          </table>

          {{-- Tombol Tambah Feedback --}}
          @if ($bap->feedbacks->count() < 2)
            <a href="{{ route('mahasiswa.feedback.create', $bap->id) }}" class="btn btn-primary">
              Tambah Feedback
            </a>
          @else
            <div class="alert alert-warning mt-3">Feedback sudah penuh.</div>
          @endif

          {{-- Menampilkan Feedback yang sudah ada --}}
          <h5 class="mt-4">Feedback Mahasiswa</h5>
          @if ($bap->feedbacks->isEmpty())
            <p>Belum ada feedback.</p>
          @else
            <table class="table-bordered table">
              <thead>
                <tr>
                  <th>Nama Mahasiswa</th>
                  <th>Feedback</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bap->feedbacks as $feedback)
                  <tr>
                    <td>{{ $feedback->nama_mahasiswa }}</td>
                    <td>{{ $feedback->feedback }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif

          <a href="{{ route('mahasiswa.bap.index') }}" class="btn btn-secondary mt-3">Kembali</a>

        </div>
      </div>
    </div>
  </div>
@endsection
