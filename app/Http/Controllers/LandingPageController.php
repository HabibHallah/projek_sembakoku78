<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{
    public function index()
    {
        $barang = Barang::where('status', 1)->get(); // Ambil barang yang tersedia
        return view('landingpage', compact('barang'));
    }

    public function addToCart(Request $request)
{
    // Ambil keranjang dari sesi (session) menggunakan Session facade
    $cart = Session::get('cart', []);

    // Ambil data dari request
    $id = $request->id;
    $name = $request->name;
    $price = $request->price;
    $quantity = $request->quantity;
    $totalPrice = $request->totalPrice;

    // Jika barang sudah ada di keranjang, tambahkan jumlahnya
    if (isset($cart[$id])) {
        $cart[$id]['quantity'] += $quantity; // Tambahkan quantity
        $cart[$id]['totalPrice'] = $totalPrice; // Update total price
    } else {
        // Tambahkan barang baru ke keranjang
        $cart[$id] = [
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'totalPrice' => $totalPrice,
        ];
    }

    // Simpan kembali keranjang ke sesi menggunakan Session facade
    Session::put('cart', $cart);

    // Mengembalikan respons dengan data keranjang
    return response()->json(['success' => true, 'cart' => $cart]);
}


    // Mendapatkan isi keranjang
    public function getCart()
    {
        $cart = Session::get('cart', []);
        return response()->json($cart);
    }

    public function removeFromCart($id)
    {
        // Mengambil keranjang dari sesi menggunakan Session facade
        $cart = Session::get('cart', []);

        // Menghapus barang dari keranjang
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        // Simpan kembali keranjang ke sesi menggunakan Session facade
        Session::put('cart', $cart);

        return response()->json(['success' => true, 'cart' => $cart]);
    }

    public function search(Request $request)
    {
        // Ambil query pencarian dari parameter 'query'
        $query = $request->input('query');

        // Cari barang yang namanya mengandung query pencarian
        $barang = Barang::where('nama_barang', 'like', "%$query%")->get();

        // Kembalikan view dengan data barang yang ditemukan
        return view('landingpage', compact('barang'));
    }

    public function storeOrder(Request $request)
    {
        try {
            // Ambil data yang diperlukan dari request
            $cartItems = session('cart', []); // Ambil data keranjang dari session
            $totalAmount = 0;
            foreach ($cartItems as $item) {
                $totalAmount += $item['totalPrice']; // Total harga
            }

            // Menyimpan data pesanan
            foreach ($cartItems as $item) {
                Pesanan::create([
                    'barang_id' => $item['id'],       // ID barang
                    'user_id' => Auth::id(),          // ID user yang sedang login
                    'jumlah' => $item['quantity'],    // Jumlah barang yang dipesan
                    'status' => 1,                    // Status pesanan (misalnya 1 untuk selesai)
                    'total' => $item['totalPrice'],   // Total harga per barang
                ]);
            }

            // Jika pesanan berhasil disimpan
            Log::info('Pesanan berhasil disimpan', ['user_id' => Auth::id(), 'total_amount' => $totalAmount]);

        } catch (\Exception $e) {
            // Menangani jika terjadi kesalahan saat menyimpan
            Log::error('Gagal menyimpan pesanan', ['error' => $e->getMessage()]);
        }
    }
}
