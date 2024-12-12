<?php

namespace App\Http\Controllers\cards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Riwayat;

class CardBasic extends Controller
{
  public function index()
    {
        // Mengambil semua data riwayat
        $riwayats = Riwayat::with('barang')->get();  // pastikan ada relasi 'barang'

        // Mengirim data riwayats ke view
        return view('riwayat', compact('riwayats'));
    }
}
