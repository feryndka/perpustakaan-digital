@extends('user.components.layout')

@section('header')
    <h1 class="text-bold">Detail Buku</h1>
@endsection

@section('content')
    <div class="flex flex-col md:flex-row justify-center md:justify-start p-6 bg-white rounded-lg shadow-lg">
        <!-- Book Image Section -->
        <div class="w-full h-fit md:w-1/2 flex justify-center mb-6 md:mb-0">
            <img src="{{ asset('storage/image/' . $buku->image) }}" alt="Book Cover" class="w-2/3 md:w-1/2">
        </div>

        <!-- Book Details Section -->
        <div class="w-full md:w-1/2 px-6">
            <h1 class="text-2xl font-semibold mb-4">{{ $buku->judul }}</h1>

            <!-- Author & Location -->
            <div class="flex items-center mb-2 text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-person text-pink-500" viewBox="0 0 16 16">
                    <path
                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
                <span class="ml-2 font-semibold">{{ $buku->penulis }}</span>
            </div>
            <div class="flex items-center mb-2 text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-geo-alt-fill text-pink-500" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                </svg>
                <span class="ml-2 font-semibold">{{ $buku->lokasi }}</span>
            </div>

            <!-- Availability Status -->
            <div class="flex items-center mb-4">
                <span class="w-5 h-5 rounded-full {{ $buku->tersedia ? 'bg-green' : 'bg-red' }}"></span>
                <span class="ml-2 font-semibold">{{ $buku->tersedia ? 'Tersedia' : 'Tidak Tersedia' }}</span>
            </div>

            <!-- Description -->
            <p class="text-gray-700 mb-4 text-justify">{{ $buku->deskripsi }}</p>

            <!-- Borrow Button -->
            <button class="bg-primary btn w-full">
                Pinjam
            </button>
        </div>
    </div>
@endsection
