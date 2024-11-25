@extends('admin.components.layout')

@section('header')
    <h1 class="text-center text-bold">PERMINTAAN PEMINJAMAN</h1>
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
                    <form action="{{ route('admin.pinjam.index') }}" method="get" class="input-group flex">
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
                                <th>Nama Anggota</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Permohonan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Looping through data_peminjaman --}}
                            @foreach ($result as $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['idAnggota'] }}</td>
                                    <td>{{ $item['idBuku'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item['createdOn'])->format('d/m/Y') }}</td>
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
                                                onclick="approve_peminjaman(this)">Terima</button>
                                        </form>
                                        {{-- Delete Button --}}
                                        <form action="{{ route('admin.pinjam.destroy', $item['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="reject_peminjaman(this)">Tolak</button>
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
