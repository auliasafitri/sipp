<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        return view('user', ["title" => "akun", "user" => User::all()]);
    }
    public function create(Request $request)
    {
        $stok = User::create([
            'username' => $request->username,
            'password' => $request->password,
            'level' => $request->level,
        ]);
        session()->flash("success", "data berhasil ditambah");
        return redirect("/akun");
    }
    public function edit(Request $request)
    {
    $akun = User::find($request->id);
    $akun->username = $request->username;
    $akun->password = $request->password;
    $akun->level = $request->level;
    $akun->save();
    session()->flash("success", "data berhasil diubah");
        return redirect("/akun");
    }
    public function delete(Request $request)
    {
    $id = $request->id_akun;
    User::find($id)->delete();
    session()->flash("success", "data berhasil dihapus");
    return redirect()->back();
    }
}