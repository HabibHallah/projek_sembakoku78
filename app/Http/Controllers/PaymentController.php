<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // Gunakan false untuk sandbox
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createPayment(Request $request)
    {
        $cartItems = $request->input('cart_data');
        $totalAmount = 0;

        foreach ($cartItems as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        $orderId = 'ORD-' . time();
        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => $totalAmount,
        ];

        $items = [];
        foreach ($cartItems as $item) {
            $items[] = [
                'id' => $item['id'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'name' => $item['name'],
            ];
        }

        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        $customerDetails = [
            'first_name' => $user->name,  // Nama pengguna yang sedang login
            'email' => $user->email,      // Email pengguna
            'phone' => $user->phone ?? '08123456789',  // Nomor telepon pengguna, jika ada
        ];

        $transactionData = [
            'payment_type' => 'credit_card',
            'transaction_details' => $transactionDetails,
            'item_details' => $items,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($transactionData);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create transaction'], 500);
        }
    }

    public function finish(Request $request)
    {
        $transactionStatus = $request->input('transaction_status');
        $orderId = $request->input('order_id');

        if ($transactionStatus == 'settlement') {
            // Panggil fungsi storeOrder() setelah pembayaran berhasil
            $landingPageController = new LandingPageController();
            $landingPageController->storeOrder($request);

            Log::info('Pesanan berhasil diselesaikan', ['order_id' => $orderId, 'status' => $transactionStatus]);
            return view('payment.success', ['order_id' => $orderId]);
        } else if ($transactionStatus == 'pending') {
            return view('payment.pending', ['order_id' => $orderId]);
        } else {
            return view('payment.failed', ['order_id' => $orderId]);
        }
    }
}
