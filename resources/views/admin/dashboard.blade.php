@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <p>Selamat datang, {{ Auth::user()->name }}!</p>
    </div>
  </div>
@endsection
