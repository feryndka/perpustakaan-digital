@extends('admin.components.layout')

@section('header')
    <h1>Dashboard Admin</h1>
@endsection

@section('content')
    <p>Halo, {{ Auth::user()->nama }}</p>
@endsection
