<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardAnalyticsController;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TambahData;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PesananController;

// Main Page Route
Route::get('/dashboards-analytics', [DashboardAnalyticsController::class, 'index'])->name('dashboard-analytics');

//landingpage
Route::get('/', function () {
    return view('landingpage');
});

// Landing Page yang hanya bisa diakses oleh pengguna yang telah login
Route::get('/', function () {
  return view('landingpage');
})->middleware('auth');

//pesanan
Route::post('/store-pesanan', [PesananController::class, 'storePesanan']);

// Route untuk halaman keranjang atau pemesanan, hanya bisa diakses oleh pengguna yang sudah login
Route::get('/order', function () {
    return view('order'); // Ganti dengan tampilan untuk pemesanan
})->middleware('auth');


// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::post('/auth/login-basic', [LoginBasic::class, 'login']);  // Rute POST untuk login
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::post('/auth/register-basic', [RegisterBasic::class, 'register'])->name('register-basic'); // Rute POST untuk pendaftaran
Route::post('/logout', [LoginBasic::class, 'logout'])->name('logout');

// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tambah data
Route::get('/TambahData/data-barang', [TambahData::class, 'index'])->name('data-barang');
Route::get('/TambahData/barang', [BarangController::class, 'create'])->name('barang.create');
Route::post('/TambahData/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

//landingpage
Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');

//keranjang
Route::post('/cart/add', [LandingPageController::class, 'addToCart'])->name('cart.add');
Route::get('/get-cart', [LandingPageController::class, 'getCart'])->name('get-cart');
Route::delete('/cart/remove/{id}', [LandingPageController::class, 'removeFromCart'])->name('cart.remove');

// Route untuk menampilkan hasil pencarian
Route::get('/search', [LandingPageController::class, 'search'])->name('search');

//Pembayaran
Route::post('/payment', [PaymentController::class, 'createPayment']);

Route::get('/payment/finish', [PaymentController::class, 'finish']);
