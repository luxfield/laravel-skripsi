<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratJalanController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $barang = DB::table('surat_jalan')->get();
        return response()->view('barang', [
            'data_barang' => $barang,
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
        ]);
    }
    public function tambah(Request $request)
    {
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        return response()->view('product.add',[
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
        ]);
    }
    public function cek_slip(Request $request)
    {
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $barang = DB::table('surat_jalan')->where('nomor_slip','=', $request->id)->get();
        $sipb = DB::table('sipb')->where('nomor_sipb','=', $barang[0]->nomor_sipb)->get();
        $pelanggan = DB::table('pelanggan')->where('id_pelanggan','=', $sipb[0]->id_pelanggan)->get();
        $material = DB::table('surat_jalan_trx')->where('nomor_sipb','=', $barang[0]->nomor_sipb)->get();

        return response()->view('staff_gudang.slip.article', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_slip' => $barang,
            'data_sipb' => $sipb,
            'data_material' => $material,
            'data_pelanggan' => $pelanggan,
        ]);
    }
    public function cek_sipb(Request $request)
    {
        $sipb = DB::table('sipb')->where('nomor_sipb', '=', $request->id)->get();
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();

        $material = DB::table('surat_jalan_trx')->where('nomor_sipb','=', $request->id)->get();
        return response()->view('staff_gudang.sipb.article', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_sipb' => $sipb,
            'data_material' => $material,
        ]);
    }
}
