@extends('user.components.layout')

@section('header')
    <h1 class="text-center text-bold">KATALOG BUKU</h1>
    <div class="flex justify-center pt-2">
        <div class="h-1 bg-black rounded w-20"></div>
    </div>
@endsection

@section('content')
    <div class="container">
        {{-- Search bar --}}
        <form action="{{ route('user.dashboard.index') }}" method="get" class="input-group flex justify-center mb-6">
            @csrf
            <input class="form-control max-w-md hover:shadow-md" name="search" type="search" placeholder="Search..."
                aria-label="Search" value="{{ request('search') }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-sidebar bg-dark">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </form>

        <div class="grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-5 pb-4">
            @foreach ($buku as $buku)
                <!-- Katalog Buku -->
                <a href="/user/dashboard/{{ $buku->id }}" class="rounded-lg overflow-hidden border-2 hover:shadow-md">
                    <img src="{{ asset($buku->image) }}" alt="{{ $buku->judul }}"
                        class="w-full max-h-72 object-cover img-thumbnail">
                    <div class="p-2">
                        <h5 class="text-bold text-lg text-black">{{ $buku->judul }}</h5>
                        <p class="text-gray-500 truncate mb-2">{{ $buku->penulis }}</p>
                        <p class="px-2 py-1 text-sm rounded-lg badge {{ $buku->tersedia ? 'bg-blue' : 'bg-red' }}">
                            {{ $buku->tersedia ? 'Tersedia' : 'Tidak tersedia' }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="pagination flex justify-center">
            @php
                use App\Models\Buku;
                $buku = Buku::query();
                $buku = $buku->paginate(10);
            @endphp
            {{ $buku->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
