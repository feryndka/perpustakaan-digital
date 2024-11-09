@extends('admin.components.layout')

@section('header')
    <h1 class="text-center text-bold">DATA BUKU</h1>
    <div class="flex justify-center pt-2">
        <div class="h-1 bg-black rounded w-20"></div>
    </div>
@endsection

@section('content')
    <div class="row text-center">
        <div class="col">
            <div class="card">
                <div class="form-inline flex justify-between p-3">
                    {{-- Search bar --}}
                    <form action="{{ route('admin.buku.index') }}" method="get" class="input-group flex">
                        @csrf
                        <input class="form-control hover:shadow-md" name="search" type="search" placeholder="Search..."
                            aria-label="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sidebar bg-dark">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </form>
                    {{-- Button tambah data buku --}}
                    <a href="/admin/buku/create" class="btn btn-md bg-primary">
                        Tambah Data
                    </a>
                </div>
                <hr>
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
                                    <td>{{ $buku->id }}</td>
                                    <td>{{ Str::limit($buku->image, 15) }}</td>
                                    <td>{{ Str::limit($buku->judul, 20) }}</td>
                                    <td>{{ Str::limit($buku->penulis, 10) }}</td>
                                    <td>{{ Str::limit($buku->lokasi, 20) }}</td>
                                    <td>{{ $buku->jumlah }}</td>
                                    <td>{{ Str::limit($buku->deskripsi, 30) }}</td>
                                    <td>
                                        <p
                                            class="badge p-2 cursor-default {{ $buku->tersedia ? 'bg-green' : 'bg-yellow' }}">
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
                    <div class="pagination flex justify-center mt-4">
                        @php
                            use App\Models\Buku;
                            $buku = Buku::query();
                            $buku = $buku->paginate(5);
                        @endphp
                        {{ $buku->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
