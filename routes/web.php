<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\AntarmukaController;
use App\Http\Controllers\BarangController;
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
Route::get('/', [AntarmukaController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/DetailTransaksi/{id}/detail', [DetailTransaksiController::class, 'detail'])->name('DetailTransaksi.detail');
Route::resource('/DetailTransaksi', DetailTransaksiController::class);
Route::get('/Kategori/{id}/kategori', [KategoriController::class, 'kategori'])->name('Kategori.kategori');
Route::resource('/kategori', KategoriController::class);
//<<<<<<< HEAD
Route::get('/DetailTransaksi/{id}/cetakStruk', [DetailTransaksiController::class, 'cetakStruk'])->name('cetak.struk');
Route::get('/cetakRekap', [DetailTransaksiController::class, 'cetakRekap'])->name('cetakRekap');


//=======

//Barang

Route::resource('/barang', BarangController::class);

Route::get('/createBarang', [BarangController::class, 'create'])->name('barang.create');
Route::post('/storeBarang', [BarangController::class, 'store'])->name('barang.store');

Route::get('/editBarang/{id_barang}', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/updateBarang/{id_barang}', [BarangController::class, 'update'])->name('barang.update');

Route::delete('/deleteBarang/{id_barang}', [BarangController::class, 'delete'])->name('barang.delete');


// Route::get('/cetak-struk', 'DetailTransaksiController')->name('cetak.struk');
//>>>>>>> db1fe6442a7e91227d800083835a799d9b73ae9c

Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');


// fiani
Route::get('/login', [AntarmukaController::class, 'login'])->name('login');
Route::post('/login', [AntarmukaController::class, 'postlogin']);
Route::get('/logout', function () {
    session()->flush();
    return redirect("/login");
});
Route::get('/stok', function () {
    return view('stok', ["title" => "stok", "stok" => stok::join("barangs", "stok.id_barang", "=", "barangs.id_barang")->join("kategoris", "barangs.id_kategori", "=", "kategoris.id_kategori")->get()]);
});
Route::post('/stok', function (Request $request) {
    // memasukkan ke tabel user
    $stok = stok::create([
        'id_barang' => "1",
        'stok_barang' => $request->stok_barang,
        'tanggal_stok' => $request->tanggal_stok,
    ]);
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
    return redirect("/akun");
});
Route::post('/stok/hapus', function (Request $request) {
    $id = $request->id_stok;
    stok::find($id)->delete();
    return redirect()->back();
});
Route::post('/akun/hapus', function (Request $request) {
    $id = $request->id_akun;
    User::find($id)->delete();
    return redirect()->back();
});
