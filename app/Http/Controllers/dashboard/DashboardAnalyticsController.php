<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pesanan;

class DashboardAnalyticsController extends Controller
{
    public function index()
    {

        // Hitung jumlah jenis barang
        $totalJenisBarang = Barang::count();

        // Hitung total harga dari semua barang yang telah terjual (status selesai)
        $totalSales = Pesanan::where('status', 1)->sum('total');

        return view('content.dashboard.dashboards-analytics', compact('totalJenisBarang', 'totalSales')); // Correct view path
    }
}
