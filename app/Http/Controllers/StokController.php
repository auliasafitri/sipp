<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        return view('stok', ["barang" => Barang::all(), "title" => "stok", "stok" => stok::join("barangs", "stok.id_barang", "=", "barangs.id_barang")->join("kategoris", "barangs.id_kategori", "=", "kategoris.id_kategori")->get()]);
    }
    public function create(Request $request)
    {
        $stok = stok::create([
            'id_barang' => $request->id_barang,
            'stok_barang' => $request->stok_barang,
            'tanggal_stok' => $request->tanggal_stok,
        ]);
        session()->flash("success", "data berhasil ditambah");
        return redirect("/stok");
    }
    public function edit (Request $request)
    {
        $stok = Stok::find($request->id);
        $stok->stok_barang = $request->stok_barang;
        $stok->tanggal_stok = $request->tanggal_stok;
        $stok->save();
        session()->flash("success", "data berhasil diubah");
            return redirect("/stok");
    }
    public function delete (Request $request)
    {
    $id = $request->id_stok;
    stok::find($id)->delete();
    session()->flash("success", "data berhasil dihapus");
    return redirect()->back();
    }
}
