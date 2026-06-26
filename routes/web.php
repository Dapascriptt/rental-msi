<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserPasswordController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HargaBarangController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\SpesifikasiController;
use App\Http\Controllers\TipeController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/katalog');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/admin/users', [UserPasswordController::class, 'index'])
        ->name('admin.users.index');

    Route::get('/admin/users/{user}/reset-password', [UserPasswordController::class, 'edit'])
        ->name('admin.users.reset-password.edit');

    Route::put('/admin/users/{user}/reset-password', [UserPasswordController::class, 'update'])
        ->name('admin.users.reset-password.update');

    Route::delete('/admin/users/{user}', [UserPasswordController::class, 'destroy'])
        ->name('admin.users.destroy');

    Route::resource('tipes', TipeController::class);
    Route::resource('barangs', BarangController::class);
    Route::resource('units', UnitController::class);
    Route::resource('harga-barangs', HargaBarangController::class);
    Route::resource('pemesanan', PemesananController::class);
    Route::resource('spesifikasis', SpesifikasiController::class);
    Route::post('units/bulk-delete', [UnitController::class, 'bulkDelete'])->name('units.bulk-delete');
    Route::patch('/pemesanan/{id}/status', [PemesananController::class, 'updateStatus'])->name('pemesanan.updateStatus');
});

Route::get('/katalog', [KatalogController::class, 'katalog'])->name('units.katalog');
Route::get('/katalog/{barang}', [KatalogController::class, 'showByBarang'])->name('katalog.detail');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');
Route::get('/checkout/success', [CartController::class, 'success'])->name('checkout.success');
Route::get('/cart/remove/{barangId}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
Route::get('/cart/remove-unit/{barangId}/{unitId}', [CartController::class, 'removeUnit'])->name('cart.removeUnit');
Route::view('/tentang-kami', 'pages.tentang')->name('tentang');
