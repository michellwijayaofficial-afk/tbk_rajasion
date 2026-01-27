<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserCartController;
use App\Http\Controllers\PesananController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// Handle email verification routes - redirect to home
Route::get('/email/verify', function() {
    return redirect()->route('home')->with('info', 'Email verification tidak diperlukan.');
})->name('verification.notice');

Route::post('/email/verification-notification', function() {
    return redirect()->route('home')->with('info', 'Email verification tidak diperlukan.');
})->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function() {
    return redirect()->route('home')->with('info', 'Email verification tidak diperlukan.');
})->name('verification.verify');
Route::group(['middleware' => []], function () {
    Route::get('/', [HomeController::class, 'home']);
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::match(['get', 'post'], '/shop/{store:id}/Bahan Kue', [ShopController::class, 'index'])->name('detail_shop');
    Route::get('/shop/detail-produk/{produk:id}', [ShopController::class, 'detail_produk'])->name('detail_produk');
    Route::get('/shop/modal/{produk:id}', [ShopController::class, 'produk_modal']);
    Route::match(['get', 'post'], '/shop', [ShopController::class, 'shop_list'])->name('shop');
});

Route::group(['middleware' => ['auth', 'customer']], function () {
    Route::match(['get', 'post'], '/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/shop/keranjang', [ShopController::class, 'keranjang'])->name('keranjang');
    Route::get('/shop/konfirmasi-pesanan/', [ShopController::class, 'konfirmasi_pesanan']);
    Route::post('/shop/proses_pesanan/', [ShopController::class, 'proses_pesanan']);
    Route::post('/kec_checkout', [ShopController::class, 'kec_checkout']);
    Route::post('/shop/detail_ongkir', [ShopController::class, 'detail_ongkir']);
    Route::get('/pesanan-saya', [ShopController::class, 'pesanan_saya'])->name('pesanan_saya');
    Route::post('/keranjang/{detpesanan:id}', [ShopController::class, 'update_qty'])->name('update_qty');
    Route::delete('/keranjang/{detpesanan:id}', [ShopController::class, 'delete_qty'])->name('delete_qty');
    Route::match(['get', 'post'], '/update-password', [HomeController::class, 'update_password'])->name('update_password');
    Route::post('/pesanan/{pesanan:no_pesanan}', [ShopController::class, 'pesanan_selesai'])->name('pesanan_selesai');
    Route::post('/shop/tambah_keranjang/{produk:id}', [ShopController::class, 'tambah_keranjang'])->name('tambah_keranjang');
    Route::match(['get', 'post'], '/pembayaran/{pesanan:no_pesanan}', [ShopController::class, 'pembayaran'])->name('pembayaran');
    Route::post('/shop/cek_produk', [ShopController::class, 'cek_produk']);
});

Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'admin', 'cache']], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/produk', [AdminController::class, 'produk'])->name('admin.produk');
    Route::get('/produk/create', [AdminController::class, 'produk_create'])->name('admin.produk.create');
    Route::post('/produk', [AdminController::class, 'produk_store'])->name('admin.produk.store');
    Route::get('/produk/{produk}/edit', [AdminController::class, 'produk_edit'])->name('admin.produk.edit');
    Route::put('/produk/{produk}', [AdminController::class, 'produk_update'])->name('admin.produk.update');
    Route::delete('/produk/{produk}', [AdminController::class, 'produk_destroy'])->name('admin.produk.destroy');
    Route::get('/user/customer', [AdminController::class, 'customer'])->name('admin.user');
    Route::get('/user/admin', [AdminController::class, 'admin'])->name('admin.admin');
    Route::get('/user/carts', [UserCartController::class, 'index'])->name('admin.user.carts');
    Route::get('/pesanan', [PesananController::class, 'index'])->name('admin.pesanan');
    Route::get('/pesanan/konfirmasi', [PesananController::class, 'konfirmasi'])->name('admin.konfirmasi');
    Route::get('/pesanan/kirim', [PesananController::class, 'admin_kirim'])->name('admin.kirim');
    Route::get('/pesanan/{pesanan:no_pesanan}', [PesananController::class, 'detail'])->name('admin.detpes');
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('admin.invoice');
    Route::get('/invoice/{invoice:no_invoice}', [InvoiceController::class, 'detail'])->name('admin.detinv');
    Route::delete('/user/{user:id}', [AdminController::class, 'delete_user'])->name('delete_user');
    Route::match(['get', 'post'], '/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::match(['get', 'post'], '/user/admin/tambah', [AdminController::class, 'tambah_admin'])->name('tambah_admin');
    Route::put('/pesanan/konfirmasi/{pesanan:no_pesanan}', [PesananController::class, 'konfirmasi_bayar'])->name('konfirmasi_pembayaran');
    Route::put('/pesanan/kirim/{pesanan}', [PesananController::class, 'kirim_pesanan'])->name('admin.kirim_pesanan');
    Route::post('/laporan/pdf', [InvoiceController::class, 'pdf'])->name('admin.laporan.pdf');
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
