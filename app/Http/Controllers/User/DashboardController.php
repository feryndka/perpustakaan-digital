<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $buku = DB::table('buku')->get();
        return view("user.pages.dashboard.index", ['buku' => $buku]);
    }
}
