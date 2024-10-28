@extends('admin.components.layout')

@section('header')
    <h1 class="text-center">DATA BUKU</h1>
    <hr>
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar bg-dark">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row text-center">
        <div class="col">
            <div class="card">
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
                                    <td>{{ $buku->jumlahBuku }}</td>
                                    <td>{{ Str::limit($buku->deskripsi, 30) }}</td>
                                    <td>
                                        <p class="badge p-2 {{ $buku->tersedia ? 'bg-green' : 'bg-yellow' }}">
                                            {{ $buku->tersedia ? 'Tersedia' : 'Tidak tersedia' }}
                                        </p>
                                    </td>
                                    <td>
                                        <button class="btn bg-primary">Edit</button>
                                        <button class="btn bg-danger">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <button class="btn bg-primary">
            tambah data
        </button>
    </div>
@endsection
