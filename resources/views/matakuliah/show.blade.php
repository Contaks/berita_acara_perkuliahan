@extends('layouts.app')

@section('title', 'Detail Mata Kuliah')

@section('contents')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Detail Mata Kuliah</h5>
            </div>
            <div class="card-body">
                <p><strong>Kode MK:</strong> {{ $matakuliah->kode_mk }}</p>
                <p><strong>Nama MK:</strong> {{ $matakuliah->nama_mk }}</p>
                <p><strong>SKS:</strong> {{ $matakuliah->sks }}</p>
                <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
