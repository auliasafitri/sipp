<?php

use App\Http\Controllers\AkunController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\AntarmukaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiController;
use App\Models\Barang;
use App\Models\stok;
use App\Models\User;
use Illuminate\Http\Request;

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

Route::get('/test', function () {
    return view('welcome');
});
Route::get('/beranda', [AntarmukaController::class, 'adminDashboard'])->name('admin.dashboard');

//kategori
Route::get('/Kategori/{id}/kategori', [KategoriController::class, 'kategori'])->name('Kategori.kategori');
Route::resource('/kategori', KategoriController::class);

//Barang

Route::resource('/barang', BarangController::class);

Route::get('/createBarang', [BarangController::class, 'create'])->name('barang.create');
Route::post('/storeBarang', [BarangController::class, 'store'])->name('barang.store');

Route::get('/editBarang/{id_barang}', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/updateBarang/{id_barang}', [BarangController::class, 'update'])->name('barang.update');

Route::delete('/deleteBarang/{id_barang}', [BarangController::class, 'delete'])->name('barang.delete');


// Route Transaksi

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');

Route::get('/createTransaksi', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/storeTransaksi', [TransaksiController::class, 'store'])->name('transaksi.store');

Route::delete('transaksi/{id}', [TransaksiController::class, 'delete'])->name('transaksi.delete');


//detail transaksi
Route::get('/transaksi/{id}', [DetailTransaksiController::class, 'detail'])->name('index.detail');
Route::get('/transaksi/{id}/cetak-pdf', [DetailTransaksiController::class, 'cetakStruk'])->name('cetak-struk');
Route::get('/cetakRekap', [DetailTransaksiController::class, 'cetakRekap'])->name('cetakRekap');
Route::resource('/DetailTransaksi', DetailTransaksiController::class);





Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');


// fiani
Route::get('/', [AntarmukaController::class, 'login'])->name('login');
Route::post('/', [AntarmukaController::class, 'postlogin']);
Route::get('/logout', function () {
    session()->flush();
    return redirect("/");
});

//stok
Route::get('/stok',[StokController::class, 'index']);
Route::post('/stok', [StokController::class, 'create']);
Route::post('/stok/ubah', [StokController::class, 'edit']);
Route::post('/stok/hapus', [StokController::class, 'delete']);

    // akun
Route::get('/akun', [AkunController::class, 'index']);
Route::post('/akun', [AkunController::class, 'create']);
Route::post('/akun/ubah', [AkunController::class, 'edit']);
Route::post('/akun/hapus', [AkunController::class, 'delete']);