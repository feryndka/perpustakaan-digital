<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $anggota = Anggota::query()->where('role', 'user');
        if ($request->has("search")) {
            $anggota->where(function ($query) use ($request) {
                $query->whereAny(['nama', 'alamat', 'noHP', 'username'], "LIKE", "%" . $request->input('search') . '%');
            });
        }

        // Calculate late fees for each member
        foreach ($anggota as $user) {
            // Default late fee to 0
            $user->lateFees = 0; // Default value

            // Calculate the total late fees for this user
            $user->lateFees += $user->dataPeminjaman->sum(function ($peminjaman) {
                return $peminjaman->calculateLateFee();
            });
        }

        $anggota = $anggota->paginate(5);
        return view('admin.pages.anggota.index', compact('anggota', 'request'));
    }

    // Delete Anggota untuk di blokir
    public function delete($id)
    {
        $buku = Anggota::where('id', $id)->delete();

        return redirect('/admin/anggota')->with('deleted', true);
    }
}
