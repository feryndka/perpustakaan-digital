<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Data_Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KembaliController extends Controller
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

        // Filter status agar tidak termasuk "Persetujuan Peminjaman"
        $query->whereNotIn('status', ['Persetujuan Peminjaman']);

        // Ambil data dengan pagination
        $data = $query->paginate(5);

        // Transformasi data untuk hasil
        $result = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'idAnggota' => $item->anggota->nama ?? null, // Ambil nama anggota
                'idBuku' => $item->buku->judul ?? null, // Ambil judul buku
                'tanggal_peminjaman' => $item->tanggal_peminjaman,
                'batas_pengembalian' => $item->batas_pengembalian,
                'tanggal_kembali' => $item->tanggal_kembali,
                'status' => $item->status,
                'createdOn' => $item->createdOn
            ];
        });

        // Kirim data ke view
        return view('admin.pages.kembali.index', compact('result', 'data', 'request'));
    }

    // Approve Pengembalian function
    public function approve($id)
    {
        // Find the Data_Peminjaman record by ID
        $peminjaman = Data_Peminjaman::findOrFail($id); // Throws an exception if not found

        // Update the record
        $peminjaman->tanggal_kembali = Carbon::now(); // Set date pengembalian
        $peminjaman->status = 'Kembali'; // Change status
        $peminjaman->modifiedOn = Carbon::now(); // Set modifiedOn to now

        // Save changes to the Data_Peminjaman record
        $peminjaman->save();

        // Redirect back with a success message
        return redirect()->route('admin.kembali.index')->with('approved_pengembalian', true);
    }

    // Function to reject pengembalian -- revert status to Dipinjam
    public function reject($id)
    {
        // Find and delete the instance of Data_Peminjaman
        $peminjaman = Data_Peminjaman::findOrFail($id); // Finds the record or throws an exception
        $peminjaman->status = 'Dipinjam'; // Change status
        $peminjaman->modifiedOn = Carbon::now(); // Set modifiedOn to now

        // Save changes to the Data_Peminjaman record
        $peminjaman->save();

        // Redirect back with a success message
        return redirect()->route('admin.kembali.index')->with('rejected_pengembalian', true);
    }
}
