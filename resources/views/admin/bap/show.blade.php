@extends('layouts.admin.app')

@section('title', 'Detail BAP')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detail Berita Acara Perkuliahan</h3>
        </div>
        <div class="card-body">
          <table class="table-bordered table">
            <tr>
              <th>ID BAP</th>
              <td>{{ $bap->id }}</td>
            </tr>
            <tr>
              <th>Tanggal</th>
              <td>{{ \Carbon\Carbon::parse($bap->tanggal)->format('d-m-Y') }}</td>
            </tr>
            <tr>
              <th>Mata Kuliah</th>
              <td>{{ $bap->jadwal->mataKuliah->nama_mk ?? 'Tidak tersedia' }}</td>
            </tr>
            <tr>
              <th>Materi</th>
              <td>{{ $bap->materi }}</td>
            </tr>
            <tr>
              <th>Keterangan</th>
              <td>{{ $bap->keterangan ?? '-' }}</td>
            </tr>
            <tr>
              <th>Status</th>
              <td><span class="badge badge-info">{{ ucfirst($bap->status) }}</span></td>
            </tr>
          </table>

          <h4 class="mt-4">Feedback Mahasiswa</h4>
          @if ($bap->feedbacks->isNotEmpty())
            <table class="table-striped table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Mahasiswa</th>
                  <th>Feedback</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bap->feedbacks as $index => $feedback)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $feedback->nama_mahasiswa }}</td>
                    <td>{{ $feedback->feedback }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <p>Tidak ada feedback dari mahasiswa.</p>
          @endif
        </div>

        <div class="card-footer">
          <a href="{{ route('admin.bap.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
      </div>
    </div>
  </div>
@endsection
