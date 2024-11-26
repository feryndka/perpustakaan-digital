<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Data_Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
                'batas_pengembalian' => $item->batas_pengembalian,
                'tanggal_kembali' => $item->tanggal_kembali,
                'createdOn' => $item->createdOn,
            ];
        });

        // Kirim data ke view
        return view('user.pages.peminjaman.index', compact('result', 'peminjaman', 'request'));
    }

    public function return($id)
    {
        // Find the Data_Peminjaman record by ID
        $peminjaman = Data_Peminjaman::findOrFail($id); // Throws an exception if not found

        // Update the record
        $peminjaman->status = 'Persetujuan Pengembalian'; // Change status
        $peminjaman->modifiedOn = Carbon::now(); // Set modifiedOn to now

        // Save changes to the Data_Peminjaman record
        $peminjaman->save();

        // Redirect back with a success message
        return redirect()->route('user.pinjam.index')->with('pengembalian_buku', true);
    }

    public function extend($id)
    {
        // Find the Data_Peminjaman record by ID
        $peminjaman = Data_Peminjaman::findOrFail($id); // Throws an exception if not found

        // Periksa apakah batas_pengembalian ada dan tambahkan 3 hari
        if ($peminjaman->batas_pengembalian) {
            $peminjaman->batas_pengembalian = Carbon::parse($peminjaman->batas_pengembalian)->addDays(3);
        } else {
            return redirect()->back()->with('error', 'Tanggal batas pengembalian tidak valid.');
        }

        // Update the record
        $peminjaman->status = 'Diperpanjang'; // Change status
        $peminjaman->modifiedOn = Carbon::now(); // Set modifiedOn to now

        // Save changes to the Data_Peminjaman record
        $peminjaman->save();

        // Redirect back with a success message
        return redirect()->route('user.pinjam.index')->with('perpanjang_buku', true);
    }
}
