<?php

namespace App\Http\Controllers\tables;

use App\Http\Controllers\Controller;
use App\Models\Barang; // Pastikan model Barang sudah ada dan sesuai dengan database
use Illuminate\Http\Request;

class Basic extends Controller
{
    public function index()
    {
        // Ambil semua data barang
        $barangs = Barang::all();

        // Kirim data ke view
        return view('content.TambahData.data-barang', compact('barangs'));
    }
}

