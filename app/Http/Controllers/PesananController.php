<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Barang;
use Illuminate\Support\Facades\Log;

class PesananController extends Controller
{
    public function storePesanan(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'cart_data' => 'required|array',
            'transaction_id' => 'required|string',
            'payment_status' => 'required|string',
        ]);

        try {
            Log::info('Pesanan data diterima:', ['data' => $validated]);  // Log data yang diterima

            // Menyimpan data pesanan untuk setiap item di cart
            foreach ($validated['cart_data'] as $item) {
                // Cari barang berdasarkan ID
                $barang = Barang::findOrFail($item['id']);

                // Pastikan stok mencukupi
                if ($barang->stok < $item['quantity']) {
                    return response()->json([
                        'error' => "Stok tidak mencukupi untuk barang: {$barang->nama_barang}",
                    ], 400);
                }

                // Kurangi stok barang
                $barang->decrement('stok', $item['quantity']);

                // Simpan data pesanan
                Pesanan::create([
                    'barang_id' => $item['id'],
                    'user_id' => $validated['user_id'],
                    'jumlah' => $item['quantity'],
                    'status' => ($validated['payment_status'] == 'settlement') ? 1 : 0, // Status 1 untuk selesai, 0 untuk pending
                    'total' => $item['totalPrice'],
                    'transaction_id' => $validated['transaction_id'], // Menyimpan ID transaksi untuk referensi
                ]);
            }

            return response()->json(['message' => 'Pesanan berhasil disimpan!'], 200);
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan pesanan:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal menyimpan pesanan', 'details' => $e->getMessage()], 500);
        }
    }
}
