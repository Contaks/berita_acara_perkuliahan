@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <p>Welcome to the Dashboard, {{ Auth::user()->name }}!</p>
    </div>
  </div>
@endsection
