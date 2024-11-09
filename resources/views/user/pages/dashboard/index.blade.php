@extends('user.components.layout')

@section('header')
    <h1 class="text-center text-bold">KATALOG BUKU</h1>
    <div class="flex justify-center pt-2">
        <div class="h-1 bg-black rounded w-20"></div>
    </div>
@endsection

@section('content')
    <div class="container">
        <!-- Search Bar -->
        <div class="input-group flex justify-center mb-6" data-widget="sidebar-search">
            <input class="form-control max-w-md" type="search" placeholder="Search..." aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar bg-dark">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>

        <div class="grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-5 pb-4">
            @foreach ($buku as $buku)
                <!-- Katalog Buku -->
                <a href="" class="rounded-lg overflow-hidden border-2 hover:shadow-md">
                    <img src="{{ asset('storage/image/' . $buku->image) }}" alt="buku"
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
    </div>
@endsection
