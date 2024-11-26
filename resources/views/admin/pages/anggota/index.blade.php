@extends('admin.components.layout')

@section('header')
    <h1 class="text-center text-bold">ANGGOTA PERPUSTAKAAN</h1>
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
                    <form action="{{ route('admin.anggota.index') }}" method="get" class="input-group flex">
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
                                <th>Nama Lengkap</th>
                                <th>No Telepon</th>
                                <th>Username</th>
                                <th>Alamat</th>
                                <th>Denda</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Looping data anggota --}}
                            @foreach ($anggota as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->noHP }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->alamat }}</td>
                                    <td>
                                        Rp {{ number_format($user->lateFees, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <p class="badge p-2 cursor-default bg-green">
                                            Aktif
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <form action="/admin/anggota/{{ $user->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="hapus(this)"
                                                    class="btn btn-sm bg-danger">Blokir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Paginasi --}}
                    <div class="pagination flex justify-center mt-4">
                        @php
                            use App\Models\Anggota;
                            $anggota = Anggota::query();
                            $anggota = $anggota->paginate(5);
                        @endphp
                        {{ $anggota->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
