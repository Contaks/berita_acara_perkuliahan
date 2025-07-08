@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah')

@section('contents')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Tambah Mata Kuliah</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('matakuliah.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="kode_mk" class="form-label">Kode MK</label>
                        <input type="text" class="form-control" id="kode_mk" name="kode_mk" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_mk" class="form-label">Nama MK</label>
                        <input type="text" class="form-control" id="nama_mk" name="nama_mk" required>
                    </div>
                    <div class="mb-3">
                        <label for="sks" class="form-label">SKS</label>
                        <input type="number" class="form-control" id="sks" name="sks" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
