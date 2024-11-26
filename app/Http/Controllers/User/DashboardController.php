<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Data_Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $buku = Buku::query();
        if ($request->has("search")) {
            $buku->where(function ($query) use ($request) {
                $query->whereAny(['judul', 'penulis', 'lokasi', 'deskripsi'], "LIKE", "%" . $request->input('search') . '%');
            });
        }
        $buku = $buku->paginate(10);
        return view("user.pages.dashboard.index", compact('buku', 'request'));
    }

    public function detail($id)
    {
        $buku = Buku::findOrFail($id);

        return view('user.pages.dashboard.detailBuku', ["buku" => $buku,]);
    }

    public function pinjam($id)
    {
        // Cari buku berdasarkan ID
        $buku = Buku::findOrFail($id);

        // Cek apakah stok buku tersedia
        if ($buku->jumlah <= 0) {
            return redirect()->route('user.dashboard.detail', $buku->id)->with('error_buku', true);
        }

        // Ambil ID pengguna yang sedang login
        $idAnggota = Auth::id();

        // Simpan data peminjaman
        Data_Peminjaman::create([
            'idAnggota' => $idAnggota,
            'idBuku' => $buku->id,
            'status' => 'Persetujuan Peminjaman',
            'createdOn' => now(),         // Set waktu pembuatan data
        ]);

        return redirect()->route('user.pinjam.index')->with('pinjam_buku', true);
    }
}
