<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori; 
use App\Models\Transaksi; 
use App\Models\stok; 
use App\Models\DetailTransaksi;



class TransaksiController extends Controller
{
    public function index(){

        $dataBarang = Barang::get();
        return view('transaksi.transaksi', compact('dataBarang'), ["title" => "Tambah Transaksi"] );

    }

    // public function create()
    // {
    //     $dataBarang = Barang::get();
    //     return view('transaksi.createTransaksi', compact('dataBarang'), ["title" => "Transaksi"] );
    // }

    public function store(Request $request)
    {
        //dd($request->all());
        // Validasi data yang diterima dari form
        $request->validate([
            'total_barang' => 'required|integer|min:1',
            'grand_total' => 'required|numeric|min:0',
            'daftar_barang' => 'required|array|min:1',
            'harga_bayar' => 'required|numeric|min:0',
            'harga_kembali' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        // Ubah format grand_total dan harga_kembali dari string ke numeric
        $grandTotalNumeric = preg_replace("/[^0-9]/", "", $request->grand_total);
        $hargaKembaliNumeric = preg_replace("/[^0-9]/", "", $request->harga_kembali);


        // Simpan data ke tabel transaksi
        $transaksi = new Transaksi();
        $transaksi->total_barang = $request->total_barang;
        $transaksi->grand_total = $grandTotalNumeric;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->harga_bayar = $request->harga_bayar;
        $transaksi->harga_kembali = $hargaKembaliNumeric;
        $transaksi->save();


        // proses menyimpan detail_transaksi
        foreach ($request->daftar_barang as $barang) {
        $detailTransaksi = new DetailTransaksi();
        $detailTransaksi->id_transaksi = $transaksi->id; // Ambil id_transaksi dari transaksi yang baru dibuat
        $detailTransaksi->barang_id = $barang['id'];
        $detailTransaksi->jumlah_barang = $barang['jumlah'];
        $detailTransaksi->sub_total = $barang['sub_total'];
        $detailTransaksi->save();
        }

        // Mengurangi stok barang
        $stokBarang = Stok::where('id_barang', $barang['id'])->first();
        if ($stokBarang) {
            $stokBarang->stok_barang -= $barang['jumlah'];
            $stokBarang->save();
        }

        // Redirect ke halaman daftar_transaksi
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function delete($id)
    {
        // Temukan transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Hapus transaksi
        $transaksi->delete();

        // Redirect ke halaman daftar transaksi atau halaman lain yang sesuai
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }


}
