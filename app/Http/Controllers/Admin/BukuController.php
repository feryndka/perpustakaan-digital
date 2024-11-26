<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $buku = Buku::query();
        if ($request->has("search")) {
            $buku->where(function ($query) use ($request) {
                $query->whereAny(['judul', 'penulis', 'lokasi', 'deskripsi'], "LIKE", "%" . $request->input('search') . '%');
            });
        }
        $buku = $buku->paginate(5);
        return view('admin.pages.buku.index', compact('buku', 'request'));
    }

    public function create()
    {
        return view('admin.pages.buku.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'judul' => 'required|min:5',
            'penulis' => 'required',
            'lokasi' => 'required|min:5',
            'jumlah' => 'required|integer|min:0',
            'deskripsi' => 'required',
        ], [
            'image.required' => 'Gambar harus diunggah.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Gambar harus memiliki format jpeg, jpg, atau png.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',

            'judul.required' => 'Judul buku harus diisi.',
            'judul.min' => 'Judul buku harus memiliki minimal :min karakter.',

            'penulis.required' => 'Nama penulis harus diisi.',
            
            'lokasi.required' => 'Lokasi buku harus diisi.',
            'lokasi.min' => 'Lokasi buku harus memiliki minimal :min karakter.',
            
            'jumlah.required' => 'Jumlah buku harus diisi.',
            'jumlah.integer' => 'Jumlah buku harus berupa angka.',
            'jumlah.min' => 'Jumlah buku tidak boleh kurang dari :min.',
            
            'deskripsi.required' => 'Deskripsi buku harus diisi.',
        ]);

        // Upload image
        $image = $request->file('image');
        
        // Membuat nama file yang unik berdasarkan judul buku dan ekstensi gambar
        $judulBuku = Str::slug($request->judul); // Menggunakan slug untuk nama yang aman
        $extension = $image->getClientOriginalExtension();
        $imageName = $judulBuku . '.' . $extension;
        $path = 'image/' . $imageName;

        // Simpan gambar ke storage
        Storage::disk('public')->put($path, file_get_contents($image));

        // Tentukan nilai field `tersedia`
        $tersedia = $request->jumlah > 0; // true jika jumlah > 0, false jika tidak

        // Simpan data ke database
        Buku::create([
            'image' => 'storage/' . $path, // Path relatif yang disimpan ke DB
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'lokasi' => $request->lokasi,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
            'tersedia' => $tersedia, // Simpan nilai tersedia
        ]);

        return redirect('/admin/buku')->with('added', true);
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);

        return view('admin.pages.buku.edit', [
            "buku" => $buku,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'judul' => 'required|min:5',
            'penulis' => 'required',
            'lokasi' => 'required|min:5',
            'jumlah' => 'required|integer|min:0',
            'deskripsi' => 'required',
        ]);

        $buku = Buku::findOrFail($id);

        // Cek kalau cover lama sudah ada dan delete
        if ($buku->image) { // Jika ada gambar
            // Ensure the old image path is correct.
            $oldImagePath = str_replace('storage/', '', $buku->image); // Removing 'storage/' for deletion check
            if (Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath); // Delete the old image
            }
        }

        // Upload new image
        $image = $request->file('image');
        $judulBuku = Str::slug($request->judul); // Use slug for a safe name
        $extension = $image->getClientOriginalExtension();
        $imageName = $judulBuku . '.' . $extension;

        // Store the new image
        $path = $image->storeAs('image', $imageName, 'public');

        // Tentukan nilai field `tersedia`
        $tersedia = $request->jumlah > 0; // true if jumlah > 0

        // Update the book's details
        $buku->update([
            'image' => 'storage/' . $path, // Store the relative path
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'lokasi' => $request->lokasi,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
            'tersedia' => $tersedia, // Save availability status
        ]);

        return redirect('/admin/buku')->with('updated', true);
    }

    public function delete($id)
    {
        $buku = Buku::where('id', $id)->delete();

        return redirect('/admin/buku')->with('deleted', true);
    }
}
