@extends('user.components.layout')

@section('header')
    <h1>Dashboard Peminjam</h1>
@endsection

@section('content')
    <p>Halo, {{ Auth::user()->nama }}</p>
@endsection
