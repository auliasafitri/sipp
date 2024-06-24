<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pegawai;
use App\Models\Lokasi;
use App\Models\KelolaBarang;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class AntarmukaController extends Controller
{
 
    public function index()
    {
        //Login View
        dd('a');
        return view('auth.login');
    }

    public function adminDashboard()
    {
        //dashboard view admin
        
        $data['title'] = 'Dashboard';
        $data['kategori'] = DB::table('kategoris')->count();
        $data['barang'] = DB::table('barangs')->count(); // Ambil semua data barang

        return view('dashboard.admin', $data);
    }

    public function stafDashboard()
    {
        //dashboard view staf
        $data['title'] = 'Dashboard';
        return view('dashboard.staf', $data);
    }

    public function kepalaItDashboard()
    {
        //dashboard view kep_it
        $data['title'] = 'Dashboard';
        return view('dashboard.kep_it', $data);
    }

    public function pegawaiView()
    {
        //View Pegawai
        $data = Pegawai::all();
        return view('pegawai.view_pegawai', compact('data'), ["title" => "Data Pegawai"]);
    }

    // public function stokBarang()
    // {
    //   
    // }

    public function destroy($id)
    {
        //
    }
}
