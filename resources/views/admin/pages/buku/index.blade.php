@extends('admin.components.layout')

@section('header')
    <h1 class="text-center">DATA BUKU</h1>
    <hr>
@endsection

@section('content')
    <div class="row text-center">
        <div class="col">
            <div class="card">
                <div class="card-header form-inline d-flex justify-content-end">
                    {{-- <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar bg-dark">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div> --}}
                    <a href="/admin/buku/create" class="btn btn-md bg-primary">
                        Tambah Data
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Cover</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Lokasi</th>
                                <th>Jumlah</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buku as $buku)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $buku->image }}</td>
                                    <td>{{ $buku->judul }}</td>
                                    <td>{{ $buku->penulis }}</td>
                                    <td>{{ $buku->lokasi }}</td>
                                    <td>{{ $buku->jumlah }}</td>
                                    <td>{{ Str::limit($buku->deskripsi, 30) }}</td>
                                    <td>
                                        <p class="badge p-2 {{ $buku->tersedia ? 'bg-green' : 'bg-yellow' }}">
                                            {{ $buku->tersedia ? 'Tersedia' : 'Tidak tersedia' }}
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/admin/buku/edit/{{ $buku->id }}"
                                                class="btn btn-sm bg-primary mr-2">Edit</a>
                                            <form action="/admin/buku/{{ $buku->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm bg-danger">Hapus</button>
                                            </form>
                                        </div>
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
