@extends('admin.components.layout')

@section('header')
    <h1>EDIT DATA BUKU</h1>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <form action="/admin/buku/{{ $buku->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') is-invalid @enderror"
                                value="{{ old('image', $buku->image) }}">
                            @error('image')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" name="judul" id="judul"
                                class="form-control @error('judul') is-invalid @enderror"
                                value="{{ old('judul', $buku->judul) }}">
                            @error('judul')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penulis" class="form-label">Penulis Buku</label>
                            <input type="text" name="penulis" id="penulis"
                                class="form-control @error('penulis') is-invalid @enderror"
                                value="{{ old('penulis', $buku->penulis) }}">
                            @error('penulis')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lokasi" class="form-label">Lokasi Buku</label>
                            <input type="text" name="lokasi" id="lokasi"
                                class="form-control @error('lokasi') is-invalid @enderror"
                                value="{{ old('lokasi', $buku->lokasi) }}">
                            @error('lokasi')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="form-label">Jumlah Buku</label>
                            <input type="number" inputmode="numeric" name="jumlah" id="jumlah"
                                class="form-control @error('jumlah') is-invalid @enderror"
                                value="{{ old('jumlah', $buku->jumlah) }}">
                            @error('jumlah')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="form-label">Deskripsi Buku</label>
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"
                                class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="/admin/buku" class="btn btn-sm btn-outline-primary mr-2">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
