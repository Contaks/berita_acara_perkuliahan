@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('contents')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Data Mata Kuliah</h5>
                <a href="{{ route('matakuliah.create') }}" class="btn btn-primary btn-sm">Tambah Mata Kuliah</a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode MK</th>
                            <th>Nama MK</th>
                            <th>SKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mataKuliahs as $mataKuliah)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mataKuliah->kode_mk }}</td>
                                <td>{{ $mataKuliah->nama_mk }}</td>
                                <td>{{ $mataKuliah->sks }}</td>
                                <td>
                                    <a href="{{ route('matakuliah.show', $mataKuliah->id) }}" class="btn btn-info btn-sm">Show</a>
                                    <a href="{{ route('matakuliah.edit', $mataKuliah->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('matakuliah.destroy', $mataKuliah->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data mata kuliah</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
