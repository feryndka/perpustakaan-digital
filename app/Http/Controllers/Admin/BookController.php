<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $buku = DB::table('buku')->get();
        return view('admin.buku', ['buku' => $buku]);
    }
}
