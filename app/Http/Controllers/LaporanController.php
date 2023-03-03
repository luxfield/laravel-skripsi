<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        return response()->view('report.index', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
        ]);
    }
    public function laporanSlip(Request $request)
    {
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $barang = DB::table('surat_jalan')->get();
        return response()->view('report.slip.article', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_barang' => $barang
        ]);
    }
    public function laporanSIPB(Request $request)
    {
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $sipb = DB::table('sipb')->get();
        return response()->view('report.sipb.article', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_sipb' => $sipb,
        ]);
    }
    public function laporanPenjadwalan(Request $request)
    {
        $user =  DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $jadwal =  DB::table('jadwal_pengiriman')->get();

        return response()->view('report.schedule.article', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_jadwal' => $jadwal,

        ]);
    }

    public function SIPBgeneratePDF(Request $request)
    {
        // $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        // $sipb = DB::table('sipb')->where('nomor_sipb', '=', $request->id)->get();
        // $barang = DB::table('barang_keluar')->where('nomor_sipb', '=', $request->id)->get();
        // $material = DB::table('barang_keluar_trx')
        //     ->join('data_barang', 'barang_keluar_trx.nomor_material', '=', 'data_barang.kode_material')
        //     ->where('barang_keluar_trx.nomor_sipb', '=', $sipb[0]->nomor_sipb)
        //     ->get();

        // FacadePdf::setOption([
        //     'defaultFont' => 'Arial',
        //     'isHtml5ParserEnabled' => true,
        // ]);
        // $page = view('pdf.sipb', [
        //     "data_sipb" => $sipb,
        //     "data_slip" => $barang,
        //     "data_material" => $material
        // ])->render();
        // dd($page);
        // $pdf = FacadePdf::loadHTML($page);
        // FacadePdf::setPaper('A4', 'portrait');
        // return $pdf->download('sipb.pdf', array("Attachment" => false));

    }
}
