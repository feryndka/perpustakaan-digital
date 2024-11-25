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
