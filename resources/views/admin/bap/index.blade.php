@extends('layouts.admin.app')

@section('title', 'Approve BAP')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5>Approve Berita Acara Perkuliahan (BAP)</h5>
          <a href="{{ route('admin.bap.approved') }}" class="btn btn-primary btn-sm">List BAP yang Sudah Diapprove</a>
        </div>
        <div class="card-body">
          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Mata Kuliah</th>
                <th>Materi</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($baps as $bap)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $bap->tanggal }}</td>
                  <td>{{ $bap->jadwal->mataKuliah->nama_mk }}</td>
                  <td>{{ $bap->materi }}</td>
                  <td>{{ $bap->keterangan }}</td>
                  <td><span class="badge badge-warning">{{ ucfirst($bap->status) }}</span></td>
                  <td>
                    <a href="{{ route('admin.bap.show', $bap->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <form action="{{ route('admin.bap.approve', $bap->id) }}" method="POST" style="display:inline;">
                      @csrf
                      <button type="submit" class="btn btn-success btn-sm">Approve</button>
                    </form>
                    <form action="{{ route('admin.bap.reject', $bap->id) }}" method="POST" style="display:inline;">
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm">Reject</button>
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
