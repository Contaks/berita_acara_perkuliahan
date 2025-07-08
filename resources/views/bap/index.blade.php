@extends('layouts.app')

@section('title', 'Data Berita Acara Perkuliahan (BAP)')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5>Data Berita Acara Perkuliahan (BAP)</h5>
          <a href="{{ route('bap.create') }}" class="btn btn-primary btn-sm">Tambah BAP</a>
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
                  <td>
                    <a href="{{ route('bap.show', $bap->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('bap.edit', $bap->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('bap.destroy', $bap->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus BAP ini?')">Delete</button>
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
