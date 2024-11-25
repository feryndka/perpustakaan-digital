@extends('user.components.layout')

@section('header')
    <h1 class="text-center text-bold">Peminjaman Buku</h1>
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
                    <form action="{{ route('user.pinjam.index') }}" method="get" class="input-group flex">
                        @csrf
                        <input class="form-control hover:shadow-md" name="search" type="search" placeholder="Search..."
                            aria-label="Search" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sidebar bg-dark">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Looping through data_peminjaman --}}
                            @foreach ($result as $item)
                                <tr>
                                    {{-- @dd($item) --}}
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['idBuku']->judul }}</td>
                                    <td>{{ $item['idBuku']->penulis }}</td>
                                    <td>{{ $item['tanggal_peminjaman'] }}</td>
                                    <td>{{ $item['tanggal_kembali'] }}</td>
                                    <td>
                                        <p class="badge p-2 cursor-default bg-primary">
                                            {{ $item['status'] }}
                                        </p>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        {{-- Approve Button --}}
                                        <form action="{{ route('admin.pinjam.approve', $item['id']) }}" method="POST"
                                            class="mr-2">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-success"
                                                onclick="retur(this)">Pengembalian</button>
                                        </form>
                                        {{-- Delete Button --}}
                                        <form action="{{ route('admin.pinjam.destroy', $item['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="">Perpanjang</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="pagination flex justify-center mt-4">
                        {{ $peminjaman->links('pagination::bootstrap-4') }} <!-- Display pagination links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
