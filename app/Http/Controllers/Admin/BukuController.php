<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $buku = DB::table('buku')->get();
        return view('admin.pages.buku.index', ['buku' => $buku]);
    }

    public function create()
    {
        return view('admin.pages.buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'judul' => 'required|min:5',
            'penulis' => 'required',
            'lokasi' => 'required|min:3',
            'jumlah' => 'required',
            'deskripsi' => 'required',
        ]);

        $image = $request->file('image');
        $nameFileImage = $image->getClientOriginalName();
        $path = 'image/' . $nameFileImage;
        Storage::disk('public')->put($path, file_get_contents($image));

        Buku::create([
            'image' => $nameFileImage,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'lokasi' => $request->lokasi,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/admin/buku');
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
            'lokasi' => 'required|min:3',
            'jumlah' => 'required',
            'deskripsi' => 'required',
        ]);

        $image = $request->file('image');
        $nameFileImage = $image->getClientOriginalName();
        $path = 'image/' . $nameFileImage;
        Storage::disk('public')->put($path, file_get_contents($image));

        Buku::where('id', $id)->update([
            'image' => $nameFileImage,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'lokasi' => $request->lokasi,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/admin/buku');
    }

    public function delete($id)
    {
        $buku = Buku::where('id', $id)->delete();

        return redirect('/admin/buku');
    }
}
