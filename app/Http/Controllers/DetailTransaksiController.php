<?php

namespace App\Http\Controllers;


use App\Models\DetailTransaksi;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\kategori;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;


class DetailTransaksiController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $data = Transaksi::orderBy('tanggal')->get();
        return view('detail_transaksi.daftarTransaksi', compact('data'),["title" => "Transaksi"] );
    }

    public function detail($id)
    {
        $transaksi = Transaksi::with('detailTransaksis.barang')->findOrFail($id);
        return view('detail_transaksi.detailStruk', compact('transaksi'), ["title" => "Detail Transaksi"]);
    }
    
    public function destroy($id)
{
    try {
        
        $transaksi = Transaksi::findOrFail($id);
            $transaksi->delete();

        return redirect()->route('DetailTransaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus transaksi: ' . $e->getMessage());
    }
}

    public function cetakStruk($id)
    {
        $transaksi = Transaksi::with('detailTransaksis.barang')->find($id);

        $pdf = FacadePdf::loadView('pdf', compact('transaksi'));
        return $pdf->stream('pdf');
    }
   
    public function cetakRekap(Request $request)
    {
        // Ambil tanggal dari dan tanggal sampai dari input request
        $tanggal_dari = Carbon::parse($request->input('tanggal_dari'))->startOfDay();
        $tanggal_sampai = Carbon::parse($request->input('tanggal_sampai'))->endOfDay();
        
        // Mengambil data transaksi dengan detail transaksinya
        $data = Transaksi::with('detailTransaksis.barang')
                    ->whereHas('detailTransaksis', function($query) use ($tanggal_dari, $tanggal_sampai) {
                        $query->whereBetween('created_at', [$tanggal_dari, $tanggal_sampai]);
                    })
                    ->get();
        
        // Load view rekap_semua.blade.php dengan data transaksi
        $pdf = PDF::loadView('rekap_pdf', compact('data', 'tanggal_dari', 'tanggal_sampai'));
        
        // Download PDF dengan nama file rekap-transaksi.pdf
        return $pdf->download('rekap-transaksi.pdf');
    }

}