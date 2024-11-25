<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Data_Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PinjamController extends Controller
{
    public function index(Request $request)
    {
        // Query awal untuk Data_Peminjaman dengan eager loading
        $query = Data_Peminjaman::with(['anggota', 'buku']);

        // Cek apakah ada parameter search
        if ($request->has('search') && !empty($request->input('search'))) {
            $searchTerm = $request->input('search');

            $query->where(function ($q) use ($searchTerm) {
                // Filter berdasarkan nama anggota
                $q->whereHas('anggota', function ($anggotaQuery) use ($searchTerm) {
                    $anggotaQuery->where('nama', 'LIKE', "%{$searchTerm}%");
                });

                // Filter berdasarkan judul buku
                $q->orWhereHas('buku', function ($bukuQuery) use ($searchTerm) {
                    $bukuQuery->where('judul', 'LIKE', "%{$searchTerm}%");
                });
            });
        }

        // Ambil data dengan pagination
        $peminjaman = $query->where('status', 'Persetujuan Peminjaman')->paginate(5);

        // Transformasi data untuk hasil
        $result = $peminjaman->map(function ($item) {
            return [
                'createdOn' => $item->createdOn,
                'idAnggota' => $item->anggota->nama ?? null, // Ambil nama anggota
                'idBuku' => $item->buku->judul ?? null, // Ambil judul buku
                'status' => $item->status,
                'id' => $item->id // Sertakan ID untuk aksi lainnya
            ];
        });

        // Kirim data ke view
        return view('admin.pages.pinjam.index', compact('result', 'peminjaman', 'request'));
    }

    // Function to delete a Data_Peminjaman instance
    public function destroy($id)
    {
        // Find and delete the instance of Data_Peminjaman
        $peminjaman = Data_Peminjaman::findOrFail($id); // Finds the record or throws an exception
        $peminjaman->delete();

        // Redirect back with a success message
        return redirect()->route('admin.pinjam.index')->with('rejected', true);
    }

    // Approve function
    public function approve($id)
    {
        // Find the Data_Peminjaman record by ID
        $peminjaman = Data_Peminjaman::findOrFail($id); // Throws an exception if not found

        // Update the record
        $peminjaman->tanggal_peminjaman = Carbon::now(); // Set current date
        $peminjaman->status = 'Dipinjam'; // Change status
        $peminjaman->modifiedOn = Carbon::now(); // Set modifiedOn to now
        $peminjaman->idPustakawan = Auth::id(); // Set idPustakawan to current user ID

        // Reduce the quantity in the Buku table
        $buku = Buku::findOrFail($peminjaman->idBuku); // Find the associated book
        if ($buku->jumlah > 0) { // Ensure there are books available
            $buku->jumlah -= 1; // Decrease quantity by 1
            $buku->save(); // Save the updated book record
        } else {
            return redirect()->back()->with('error', 'Tidak ada buku yang tersedia untuk dipinjam.');
        }

        // Save changes to the Data_Peminjaman record
        $peminjaman->save();

        // Redirect back with a success message
        return redirect()->route('admin.pinjam.index')->with('approved', true);
    }
}
