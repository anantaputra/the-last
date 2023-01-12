<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('detail/{id}', [HomeController::class, 'detail'])->name('detail');
Route::get('produk', [ProdukController::class, 'index'])->name('produk');
Route::get('kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('pesan-kirim', [KontakController::class, 'simpan'])->name('pesan.kirim');
Route::get('google', [GoogleController::class, 'redirectToGoogle'])->name('google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::prefix('user')->name('user')->group(function () {
    Route::prefix('profil')->name('.profil')->group(function () {
        Route::get('/', [ProfilController::class, 'index']);
        Route::post('simpan', [ProfilController::class, 'simpan'])->name('.simpan');
        Route::post('foto', [ProfilController::class, 'foto'])->name('.foto');
    });
    Route::prefix('alamat')->name('.alamat')->group(function(){
        Route::get('/', [AlamatController::class, 'index']);
        Route::post('simpan', [AlamatController::class, 'simpan'])->name('.simpan');
        Route::post('edit', [AlamatController::class, 'index'])->name('.edit');
        Route::post('update', [AlamatController::class, 'update'])->name('.update');
        Route::get('{id}/hapus', [AlamatController::class, 'hapus'])->name('.hapus');
        Route::get('{id}/utama', [AlamatController::class, 'utama'])->name('.set.utama');
        Route::get('hapus/edit', [AlamatController::class, 'var_edit'])->name('.var.edit');
        Route::post('ganti', [AlamatController::class, 'ganti_alamat'])->name('.ganti');
        Route::get('provinsi', [RajaOngkirController::class, 'semua_provinsi'])->name('.provinsi');
        Route::get('kota', [RajaOngkirController::class, 'kota'])->name('.kota');
    });
    Route::prefix('password')->name('.password')->group(function(){
        Route::get('/');
    });
    Route::prefix('tagihan')->name('.tagihan')->group(function(){
        Route::get('/', [TagihanUserController::class, 'index']);
        Route::get('{id}', [TagihanUserController::class, 'detail'])->name('.detail');
        Route::get('bayar/{id}', [TagihanUserController::class, 'bayar'])->name('.bayar');
    });
    Route::prefix('riwayat')->name('.riwayat')->group(function(){
        Route::get('/', [RiwayatController::class, 'index']);
        Route::get('{id}', [RiwayatController::class, 'nota'])->name('.nota');
        Route::get('terima/{id}', [RiwayatController::class, 'terima'])->name('.terima');
    });
    Route::prefix('retur')->name('.retur')->group(function(){
        Route::get('/', [ReturController::class, 'index']);
        Route::get('{id}', [ReturController::class, 'tambah'])->name('.tambah');
        Route::post('/', [ReturController::class, 'simpan'])->name('.simpan');
    });
});
Route::get('bayar', [PesananController::class, 'bayar'])->name('bayar');
Route::prefix('keranjang')->name('keranjang')->group(function(){
    Route::get('/', [KeranjangController::class, 'index']);
    Route::post('tambah', [KeranjangController::class, 'tambah'])->name('.tambah');
    Route::get('checkout', [KeranjangController::class, 'checkout'])->name('.checkout');
    Route::get('{id}/tambah', [KeranjangController::class, 'add'])->name('.add');
    Route::get('{id}/kurang', [KeranjangController::class, 'min'])->name('.min');
    Route::get('{id}/hapus', [KeranjangController::class, 'hapus'])->name('.hapus');
});
Route::prefix('pesan')->name('pesan')->group(function(){
    Route::post('/', [PesananController::class, 'pesan'])->name('.sekarang');
    Route::post('buat', [PesananController::class, 'pesan'])->name('.buat');
    Route::post('kirim', [PesananController::class, 'pesan'])->name('.kirim');
});
Route::prefix('checkout')->middleware('verified')->name('checkout')->group(function(){
    Route::get('{id}', [CheckoutController::class, 'checkout']);
    Route::get('keranjang', [CheckoutController::class, 'keranjang'])->name('.keranjang');
    Route::post('simpan', [CheckoutController::class, 'simpan'])->name('.simpan');
});
Route::get('bayar', [PesananController::class, 'bayar'])->name('bayar');
Route::post('bayar', [PesananController::class, 'simpan']);

Route::prefix('admin')->group(function () {
    
});

require __DIR__.'/auth.php';
