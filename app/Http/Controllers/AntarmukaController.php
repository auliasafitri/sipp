<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pegawai;
use App\Models\Lokasi;
use App\Models\KelolaBarang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class AntarmukaController extends Controller
{

    public function login()
    {
        //Login View
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {



        // Retrieve the user by username
        $user = User::where('username', $request->username)->where('password', $request->password)->first();


        // Check if user exists and the password is correct
        if ($user) {
            // Store user ID and level in session
            session(['id_user' => $user->id_akun]);
            session(['username' => $user->username]);
            session(['level' => $user->level]);

            // Redirect to admin dashboard with a success message
            return redirect('/beranda')->with('berhasil', 'Berhasil Login');
        }

        // Authentication failed, redirect back to login page with an error message
        session()->flash("gagal", "username atau password salah");
        return redirect()->back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function adminDashboard()
    {
        //dashboard view admin

        $data['title'] = 'Dashboard';
        $data['kategori'] = DB::table('kategoris')->count();
        $data['barang'] = DB::table('barangs')->count(); // Ambil semua data barang
        $data['stok'] = DB::table('stok')
            ->count();

        $data['akun'] = DB::table('user')
            // ->where('baca', '=', '0',)
            ->count();

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
