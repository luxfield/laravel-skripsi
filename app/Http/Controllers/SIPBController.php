<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SIPBController extends Controller
{
    //
    public function simpan_index(Request $request)
    {
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $kurir = DB::table('kurir')->get();
        $barang = DB::table('data_barang')->get(['kode_material','nama_material']);

        return response()->view('letter.add', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_kurir' => $kurir,
            'data_barang' => json_encode($barang)
        ]);
    }
    public function edit_index(Request $request)
    {
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $kurir = DB::table('kurir')->get();
        $data_sipb = DB::table('sipb')->where('nomor_sipb', '=', $request->id)->get();
        $data_item = DB::table('surat_jalan_trx')
            ->select('*')
            ->join('data_barang', 'surat_jalan_trx.nomor_material', '=', 'data_barang.kode_material')
            ->where('surat_jalan_trx.nomor_sipb', '=', $request->id)
            ->get();
        return response()->view('letter.edit', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_kurir' => $kurir,
            'data_sipb' => $data_sipb,
            'data_item' => $data_item,
            'index' => 1,
        ]);
    }
    public function index(Request $request)
    {
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $sipb = DB::table('sipb')->get();
        if (count($sipb) == 0) {
            # code...
            $pelanggan = [];
            $sipb = [];
        } else {
            $pelanggan = DB::table('pelanggan')->where('id_pelanggan','=',$sipb[0]->id_pelanggan)->get();
        }
        // return "xero";
        return response()->view('surat', [
            'pelanggan' => $pelanggan,
            "data_sipb" => $sipb,
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
        ]);
    }

    public function detail_sipb(Request $request, String $id)
    {
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $sipb = DB::table('sipb')->where('nomor_sipb', '=', $id)->get();
        $pelanggan = DB::table('pelanggan')->where('id_pelanggan','=',$sipb[0]->id_pelanggan)->get();
        $material = DB::table('surat_jalan_trx')
            ->join('data_barang', 'surat_jalan_trx.nomor_material', '=', 'data_barang.kode_material')
            ->where('surat_jalan_trx.nomor_sipb', '=', $sipb[0]->nomor_sipb)
            ->get();
        return response()->view('letter.detail', [
            "pelanggan" => $pelanggan,
            "data_sipb" => $sipb,
            "data_material" => $material,
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
        ]);
    }

    public function simpan(Request $request)
    {


        $data_sipb = DB::table('sipb')
            ->select('nomor_sipb')
            ->orderByDesc('nomor_sipb')
            ->limit(1)
            ->get();
        if (count($data_sipb) == 0) {
            $nomor_sipb = '001/SIPB/' . date('m') . '/' . date('Y');
        } else {
            $nomor_urut = substr($data_sipb[0]->nomor_sipb, 0, 3);
            $nomor_urut = intval($nomor_urut) + 1;

            if ($nomor_urut < 10) {
                $nomor_sipb = '00' . $nomor_urut . '/SIPB/' . date('m') . '/' . date('Y');
            } elseif ($nomor_urut < 100) {
                $nomor_sipb = '0' . $nomor_urut . '/SIPB/' . date('m') . '/' . date('Y');
            } else {
                $nomor_sipb = $nomor_urut . '/SIPB/' . date('m') . '/' . date('Y');
            }
        }

        // $fileName = $request->file->getClientOriginalName();

        // $request->file->move(public_path('pdf'),  $fileName);
        // dd($data_sipb);
        DB::table('sipb')->insert([
            'nomor_sipb' => $nomor_sipb,
            'nomor_kendaraan' => $request->nomor_kendaraan,
            'nama_gudang' => "UP3 Marunda",
            'id_pelanggan' => $request->id_pelanggan,
            'keterangan' => $request->keterangan,
            'file' => '',
            'nama_penerima' => $request->nama_penerima,
            'tanggal_terbit' => $request->tanggal_terbit,
            'status' => 'belum disetujui'
        ]);


        for ($i = 0; $i < count($request->nomor_material); $i++) {
            # code...
            DB::table('surat_jalan_trx')->insert([
                'nomor_sipb' => $nomor_sipb,
                'nomor_material' => $request->nomor_material[$i],
                'jumlah' => $request->jumlah[$i],
            ]);
        }
        return redirect()->route('surat-keluar');
    }

    public function hapus(Request $request)
    {
        DB::table('sipb')->where('nomor_sipb', '=', $request->id)->delete();
        DB::table('surat_jalan_trx')->where('nomor_sipb', '=', $request->id)->delete();
        return redirect()->route('surat-keluar');
    }

    public function autosearch(Request $request)
    {
        $material = DB::table('data_barang')->where('kode_material', 'like', '%' . $request->search . '%')->get();

        $data = array();
        foreach ($material as $key => $data_material) {
            # code...
            $data[] = array('label' => $data_material->kode_material, 'value' => $data_material->nama_material,);
        }
        return response()->json($data);
    }

    public function edit_index_proses(Request $request)
    {
        # code...
        // dd($_POST);
        $deleteQuery = DB::table('surat_jalan_trx')->where('nomor_sipb', '=', $request->nomor_sipb)->delete();

        DB::table('sipb')->where('nomor_sipb','=' , $request->nomor_sipb)->update([
            'nomor_kendaraan' => $request->nomor_kendaraan,
            'nama_gudang' => $request->nama_gudang,
            'id_pelanggan' => $request->id_pelanggan,
            'keterangan' => $request->keterangan,
            'tanggal_terbit' => $request->tanggal_terbit,
            'status' => 'belum disetujui',
        ]);
        if ($deleteQuery) {
            # code...
            for ($i = 0; $i < count($request->nomor_material); $i++) {
                # code...
                DB::table('surat_jalan_trx')->insert([
                    'nomor_sipb' => $request->nomor_sipb,
                    'nomor_material' => $request->nomor_material[$i],
                    'jumlah' => $request->jumlah[$i],
                ]);
            }
        }

        // $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        // $sipb = DB::table('sipb')->get();
        return redirect()->route('surat-keluar');
    }

    public function dataPelanggan(Request $request)
    {
        # code...
        $data_pelanggan = DB::table('pelanggan')->where('id_pelanggan','=',$request->id_pelanggan)->get();

        return response()->json(
            ['alamat' => $data_pelanggan[0]->alamat ]
        );
    }
}
