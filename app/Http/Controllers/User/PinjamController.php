<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Data_Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamController extends Controller
{
    public function index(Request $request)
    {
        // Ambil ID pengguna yang sedang login
        $idAnggota = Auth::id();

        // Query awal untuk Data_Peminjaman dengan filter anggota yang sedang login dan eager loading
        $query = Data_Peminjaman::with(['buku'])
            ->where('idAnggota', $idAnggota); // Filter berdasarkan ID pengguna

        // Cek apakah ada parameter search
        if ($request->has('search') && !empty($request->input('search'))) {
            $searchTerm = $request->input('search');

            $query->whereHas('buku', function ($bukuQuery) use ($searchTerm) {
                $bukuQuery->where('judul', 'LIKE', "%{$searchTerm}%") // Filter berdasarkan judul
                    ->orWhere('penulis', 'LIKE', "%{$searchTerm}%"); // Filter berdasarkan penulis
            });
        }

        // Urutkan berdasarkan ID (entri terbaru lebih dulu)
        $query->orderBy('id', 'desc');

        // Ambil data dengan pagination
        $peminjaman = $query->paginate(5);

        // Transformasi data untuk hasil
        $result = $peminjaman->map(function ($item) {
            return [
                'id' => $item->id,
                'idAnggota' => $item->anggota ?? null,
                'idBuku' => $item->buku ?? null,
                'status' => $item->status,
                'tanggal_peminjaman' => $item->tanggal_peminjaman,
                'tanggal_kembali' => $item->tanggal_kembali,
                'createdOn' => $item->createdOn,
            ];
        });

        // Kirim data ke view
        return view('user.pages.peminjaman.index', compact('result', 'peminjaman', 'request'));
    }
}
