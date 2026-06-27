<?php

use App\Http\Controllers\Auth\LoginController;        // impor controller login
use App\Http\Controllers\Auth\RegisterController;     // impor controller register
use App\Http\Controllers\Auth\UserPasswordController; // impor controller kelola password user
use App\Http\Controllers\BarangController;            // impor controller barang
use App\Http\Controllers\CartController;              // impor controller keranjang/checkout
use App\Http\Controllers\HargaBarangController;       // impor controller harga barang
use App\Http\Controllers\KatalogController;           // impor controller katalog (halaman publik)
use App\Http\Controllers\PemesananController;         // impor controller pemesanan
use App\Http\Controllers\SpesifikasiController;       // impor controller spesifikasi
use App\Http\Controllers\TipeController;              // impor controller tipe
use App\Http\Controllers\UnitController;              // impor controller unit
use Illuminate\Support\Facades\Route;                 // class Route untuk mendaftarkan URL

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/katalog');   // buka '/' -> otomatis dialihkan ke '/katalog'

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // GET /login -> tampilkan form login (diberi nama 'login')
Route::post('/login', [LoginController::class, 'login']);                        // POST /login -> proses data login dari form
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');      // POST /logout -> proses logout

Route::middleware(['auth'])->group(function () {    // SEMUA route di dalam grup ini WAJIB login dulu (middleware auth)
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register'); // form tambah user
    Route::post('/register', [RegisterController::class, 'register']);                               // simpan user baru

    Route::get('/admin/users', [UserPasswordController::class, 'index'])     // halaman daftar user
        ->name('admin.users.index');

    Route::get('/admin/users/{user}/reset-password', [UserPasswordController::class, 'edit']) // form reset password user (id user dari URL)
        ->name('admin.users.reset-password.edit');

    Route::put('/admin/users/{user}/reset-password', [UserPasswordController::class, 'update']) // simpan password baru
        ->name('admin.users.reset-password.update');

    Route::delete('/admin/users/{user}', [UserPasswordController::class, 'destroy']) // hapus user
        ->name('admin.users.destroy');

    Route::resource('tipes', TipeController::class);            // 1 baris = 7 route CRUD untuk tipe
    Route::resource('barangs', BarangController::class);       // 7 route CRUD untuk barang
    Route::resource('units', UnitController::class);           // 7 route CRUD untuk unit
    Route::resource('harga-barangs', HargaBarangController::class); // 7 route CRUD untuk harga barang
    Route::resource('pemesanan', PemesananController::class);  // 7 route CRUD untuk pemesanan
    Route::resource('spesifikasis', SpesifikasiController::class);  // 7 route CRUD untuk spesifikasi
    Route::post('units/bulk-delete', [UnitController::class, 'bulkDelete'])->name('units.bulk-delete'); // hapus banyak unit sekaligus
    Route::patch('/pemesanan/{id}/status', [PemesananController::class, 'updateStatus'])->name('pemesanan.updateStatus'); // ubah status 1 pemesanan
});

// ===== Route publik di bawah ini: BISA diakses tanpa login (untuk pengunjung) =====
Route::get('/katalog', [KatalogController::class, 'katalog'])->name('units.katalog');            // halaman katalog
Route::get('/katalog/{barang}', [KatalogController::class, 'showByBarang'])->name('katalog.detail'); // detail 1 barang (id dari URL)
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');                // tambah unit ke keranjang
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');            // halaman checkout
Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process'); // proses simpan pesanan
Route::get('/checkout/success', [CartController::class, 'success'])->name('checkout.success');   // halaman sukses checkout
Route::get('/cart/remove/{barangId}', [CartController::class, 'removeItem'])->name('cart.remove'); // hapus 1 barang dari keranjang
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');             // kosongkan seluruh keranjang
Route::get('/cart/remove-unit/{barangId}/{unitId}', [CartController::class, 'removeUnit'])->name('cart.removeUnit'); // hapus 1 unit dari keranjang
Route::view('/tentang-kami', 'pages.tentang')->name('tentang');  // tampilkan view langsung tanpa controller
