<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\AntarmukaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
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
Route::get('/stok', function () {
    return view('stok', ["barang" => Barang::all(), "title" => "stok", "stok" => stok::join("barangs", "stok.id_barang", "=", "barangs.id_barang")->join("kategoris", "barangs.id_kategori", "=", "kategoris.id_kategori")->get()]);
});
Route::post('/stok', function (Request $request) {
    // memasukkan ke tabel user
    $stok = stok::create([
        'id_barang' => $request->id_barang,
        'stok_barang' => $request->stok_barang,
        'tanggal_stok' => $request->tanggal_stok,
    ]);
    session()->flash("success", "data berhasil ditambah");
    return redirect("/stok");
});
Route::post('/stok/ubah', function (Request $request) {
    // memasukkan ke tabel user
    $stok = Stok::find($request->id);
$stok->stok_barang = $request->stok_barang;
$stok->id_barang = $request->id_barang;
$stok->tanggal_stok = $request->tanggal_stok;
$stok->save();
session()->flash("success", "data berhasil diubah");
    return redirect("/stok");
});
Route::get('/akun', function () {
    return view('user', ["title" => "akun", "user" => User::all()]);
});
Route::post('/akun', function (Request $request) {
    // memasukkan ke tabel user
    $stok = User::create([
        'username' => $request->username,
        'password' => $request->password,
        'level' => $request->level,
    ]);
    session()->flash("success", "data berhasil ditambah");
    return redirect("/akun");
});
Route::post('/akun/ubah', function (Request $request) {
    // memasukkan ke tabel user
    $akun = User::find($request->id);
$akun->username = $request->username;
$akun->password = $request->password;
$akun->level = $request->level;
$akun->save();
session()->flash("success", "data berhasil diubah");
    return redirect("/akun");
});
Route::post('/stok/hapus', function (Request $request) {
    $id = $request->id_stok;
    stok::find($id)->delete();
    session()->flash("success", "data berhasil dihapus");
    return redirect()->back();
});
Route::post('/akun/hapus', function (Request $request) {
    $id = $request->id_akun;
    User::find($id)->delete();
    session()->flash("success", "data berhasil dihapus");
    return redirect()->back();
});
