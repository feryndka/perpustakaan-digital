@extends('admin.components.layout')

@section('header')
    <h1 class="text-center text-bold">PENGEMBALIAN & PERPANJANG BUKU</h1>
    <div class="flex justify-center pt-2">
        <div class="h-1 bg-black rounded w-40"></div>
    </div>
@endsection

@section('content')
    <div class="row text-center">
        <div class="col">
            <div class="card">
                <div class="form-inline flex justify-between p-3">
                    {{-- Search bar --}}
                    <form action="{{ route('admin.kembali.index') }}" method="get" class="input-group flex">
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
                                <th>Tanggal Peminjaman</th>
                                <th>Batas Pengembalian</th>
                                <th>Tanggal Kembali</th>
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
                                    <td>{{ $item['tanggal_peminjaman'] }}</td>
                                    <td>{{ $item['batas_pengembalian'] }}</td>
                                    <td>{{ $item['tanggal_kembali'] }}</td>
                                    <td>
                                        <p class="badge p-2 cursor-default bg-primary">
                                            {{ $item['status'] }}
                                        </p>
                                    </td>
                                    @if ($item['status'] === 'Persetujuan Pengembalian')
                                        <td class="d-flex justify-content-center">
                                            {{-- Approve Button --}}
                                            <form action="{{ route('admin.kembali.approve', $item['id']) }}" method="POST"
                                                class="mr-2">
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-success"
                                                    onclick="approve_pengembalian(this)">Terima</button>
                                            </form>
                                            {{-- Delete Button --}}
                                            <form action="{{ route('admin.kembali.reject', $item['id']) }}" method="POST">
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="reject_pengembalian(this)">Tolak</button>
                                            </form>
                                        </td>
                                    @else
                                        {{-- Saat status selain "Persetujuan Pengembalian" --}}
                                        <td>
                                            <p class="text-muted cursor-default">Tidak tersedia</p>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="pagination flex justify-center mt-4">
                        {{ $data->links('pagination::bootstrap-4') }} <!-- Display pagination links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
