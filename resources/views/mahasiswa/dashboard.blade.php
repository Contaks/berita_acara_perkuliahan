@extends('layouts.mahasiswa.app')

@section('title', 'Dashboard Mahasiswa')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <p>Selamat datang, {{ Auth::user()->name }}!</p>
    </div>
  </div>
@endsection
