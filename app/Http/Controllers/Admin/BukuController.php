<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $validated = $request->validate([
            'image' => 'required',
            'judul' => 'required|min:5',
            'penulis' => 'required',
            'lokasi' => 'required|min:3',
            'jumlah' => 'required',
            'deskripsi' => 'required',
        ]);

        Buku::create($validated);

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
        $validated = $request->validate([
            'image' => 'required',
            'judul' => 'required|min:5',
            'penulis' => 'required',
            'lokasi' => 'required|min:3',
            'jumlah' => 'required',
            'deskripsi' => 'required',
        ]);

        Buku::where('id', $id)->update($validated);

        return redirect('/admin/buku');
    }

    public function delete($id)
    {
        $buku = Buku::where('id', $id)->delete();

        return redirect('/admin/buku');
    }
}
