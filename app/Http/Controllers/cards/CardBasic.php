<?php

namespace App\Http\Controllers\cards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;

class CardBasic extends Controller
{
    public function index()
    {
        // Mengambil semua data pesanan dengan relasi barang
        $pesanans = Pesanan::with('barang')->get();

        // Mengirim data pesanan ke view
        return view('riwayat', compact('pesanans'));
    }
}
