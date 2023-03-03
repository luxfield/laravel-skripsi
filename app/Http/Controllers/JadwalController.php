<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Rect;

class JadwalController extends Controller
{
    //
    public function index(Request $request)
    {
        $user =  DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $jadwal =  DB::table('jadwal_pengiriman')->get();

        return view('schedule', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_jadwal' => $jadwal,

        ]);
    }


    public function add(Request $request)
    {
        $user =  DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $barang_keluar = DB::table('surat_jalan')->get();
        $jadwal =  DB::table('jadwal_pengiriman')->get();

        return response()->view('schedule.add', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_barang_keluar' => $barang_keluar,
            'data_jadwal' => $jadwal,
        ]);
    }

    public function add_proses(Request $request)
    {
        $data_jadwal = DB::table('jadwal_pengiriman')
            ->select('nomor_pengiriman')
            ->orderByDesc('nomor_pengiriman')
            ->limit(1)
            ->get();


        if (count($data_jadwal) == 0) {
            $nomor_schd = '001/jadwal/' . date('m') . '/' . date('Y');
        } else {
            $nomor_jadwal = substr($data_jadwal[0]->nomor_pengiriman, 0, 3);
            $nomor_jadwal = intval($nomor_jadwal) + 1;

            if ($nomor_jadwal < 10) {
                $nomor_schd = '00' . $nomor_jadwal . '/jadwal/' . date('m') . '/' . date('Y');
            } elseif ($nomor_jadwal < 100) {
                $nomor_schd = '0' . $nomor_jadwal . '/jadwal/' . date('m') . '/' . date('Y');
            } else {
                $nomor_schd = $nomor_jadwal . '/jadwal/' . date('m') . '/' . date('Y');
            }
        }

        $slip = DB::table('surat_jalan')->where('nomor_slip', '=', $request->nomor_slip)->get();
        $sipb = DB::table('sipb')->where('nomor_sipb', '=', $slip[0]->nomor_sipb)->get();
        $data_sipb_material = DB::table('surat_jalan_trx')->where('nomor_sipb', '=', $sipb[0]->nomor_sipb)->get();
        $pelanggan = DB::table('pelanggan')->where('id_pelanggan', '=', $sipb[0]->id_pelanggan)->get();

        $status_pengiriman = ($request->tanggal_berangkat == date('Y-m-d')) ? 'Berangkat' : 'dijadwalkan';

        $estimasi = array();
        foreach ($data_sipb_material as $value) {
            $data_barang = DB::table('data_barang')->where('kode_material', '=', $value->nomor_material)->get();
            foreach ($data_barang as $key => $value) {
                switch ($value->satuan) {
                    case 'SET':
                        $estimasi[] = 17;
                        break;
                    case 'BM':
                        $estimasi[] = 15;
                        break;
                    case 'M':
                        $estimasi[] = 22;
                        break;
                    case 'BTG':
                        $estimasi[] = 35;
                        break;
                }

                # code...

            }
            //     # code...
        }


        $hasil = $this->sjf_method($estimasi);
        sort($estimasi);
        $hasil_sjf = $this->sjf_method($estimasi);
        $total_sjf = (array_sum($hasil_sjf) / count($hasil_sjf)) + intval($pelanggan[0]->estimasi);
        $total = (array_sum($hasil) / count($hasil)) + intval($pelanggan[0]->estimasi);

        DB::table('jadwal_pengiriman')->insert([
            'nomor_pengiriman' => $nomor_schd,
            'nomor_slip' => $request->nomor_slip,
            'perusahaan' => $pelanggan[0]->nama_perusahaan,
            'nama_penerima' => $sipb[0]->nama_penerima,
            'tanggal_berangkat' => date('Y-m-d'),
            'alamat' => $request->alamat,
            'jarak' => $pelanggan[0]->jarak,
            'estimasi' => strval($total_sjf),
            'nomor_kendaraan' => $request->nomor_kendaraan,
            'keterangan' => $request->keterangan,
            'nomor_sipb' => $request->nomor_sipb,
            'status' => $status_pengiriman
        ]);

        DB::table('kurir')->where('nomor_kendaraan', '=', $request->nomor_kendaraan)->update([
            'status' => 'pengiriman'
        ]);
        // DB::table('sjf')->insert([
        //     'nomor_pengiriman' => $request->kode_pengiriman,
        //     'nomor_slip' => $request->nomor_slip,
        //     'tanggal_berangkat' => $request->tanggal_berangkat,
        //     'alamat' => $request->alamat,
        //     'jarak' => $pelanggan[0]->jarak,
        //     'estimasi' => strval($total_sjf),
        //     'nomor_kendaraan' => $request->nomor_kendaraan,
        //     'keterangan' => $request->keterangan,
        //     'nomor_sipb' => $request->nomor_sipb
        // ]);

        return redirect()->route('tampil jadwal');
    }

    private function sjf_method(array $estimasi): array
    {
        $hasil = array();
        $temp = 0;
        foreach ($estimasi as $data) {
            # code...
            $nilai = $temp + $data;
            array_push($hasil, $nilai);
            $temp = $nilai;
        }

        return $hasil;
    }
    public function delete(Request $request)
    {
        DB::table('jadwal_pengiriman')->where('nomor_pengiriman', '=', $request->id)->delete();
        DB::table('sjf')->where('nomor_pengiriman', '=', $request->id)->delete();

        return redirect()->route('tampil jadwal');
    }

    public function pelanggan(Request $request)
    {
        $user =  DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        return view('customer', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
        ]);
    }

    public function search(Request $request)
    {
        $data_slip = DB::table('surat_jalan')->where('nomor_slip', '=', $request->nomor_slip)->get();
        $data_sipb = DB::table('sipb')->where('nomor_sipb', '=', $data_slip[0]->nomor_sipb)->get();
        $data_barang = DB::table('surat_jalan_trx')
            ->join('data_barang', 'surat_jalan_trx.nomor_material', '=', 'data_barang.kode_material')
            ->where('surat_jalan_trx.nomor_sipb', '=', $data_sipb[0]->nomor_sipb)
            ->get();
        return response()->json([
            'data_slip' => $data_slip[0],
            'data_sipb' => $data_sipb[0],
            'data_barang' => $data_barang,
        ]);
    }

    public function detail(Request $request)
    {
        $user =  DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $jadwal = DB::table('jadwal_pengiriman')->where('nomor_pengiriman', '=', $request->id)->get();
        $sipb = DB::table('sipb')->where('nomor_sipb', '=', $jadwal[0]->nomor_sipb)->get();
        $pelanggan = DB::table('pelanggan')->where('id_pelanggan', '=', $sipb[0]->id_pelanggan)->get();

        $material = DB::table('surat_jalan_trx')
            ->join('data_barang', 'surat_jalan_trx.nomor_material', '=', 'data_barang.kode_material')
            ->where('surat_jalan_trx.nomor_sipb', '=', $sipb[0]->nomor_sipb)
            ->get();
        return response()->view('schedule.detail.article', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_jadwal' => $jadwal,
            'data_sipb' => $sipb,
            'data_material' => $material,
            'data_pelanggan' => $pelanggan
        ]);
    }

    public function detail_post(Request $request)
    {
        # code...
        
        $jadwal  =  DB::table('jadwal_pengiriman')->where('nomor_pengiriman','=',$request->id)->get();
        DB::table('jadwal_pengiriman')->where('nomor_pengiriman','=',$request->id)->update([
            'status' => 'selesai',
            'berkas' => $request->berkas->getClientOriginalName(),
        ]);
        DB::table('kurir')->where('nomor_kendaraan','=',$jadwal[0]->nomor_kendaraan)->update(['status' => 'Tersedia']);
        $request->berkas->storeAs('upload',$request->berkas->getClientOriginalName());
        return response()->redirectToRoute('tampil jadwal');
    }

    public function sjf(Request $request)
    {
        $user =  DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $jadwal =  DB::table('sjf')->get();

        return view('schedule.sjf.sjf', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_jadwal' => $jadwal,

        ]);
    }

    public function edit(Request $request)
    {
        # code...
        $user =  DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $jadwal = DB::table('jadwal_pengiriman')->where('nomor_pengiriman', '=', $request->id)->get();
        $sipb = DB::table('sipb')->where('nomor_sipb', '=', $jadwal[0]->nomor_sipb)->get();
        $barang_keluar = DB::table('surat_jalan')
            ->select('*')
            ->join('jadwal_pengiriman', 'surat_jalan.nomor_slip', '=', 'jadwal_pengiriman.nomor_slip')
            ->where('jadwal_pengiriman.nomor_pengiriman', '=', $request->id)
            ->get();
        $material = DB::table('surat_jalan_trx')
            ->join('data_barang', 'surat_jalan_trx.nomor_material', '=', 'data_barang.kode_material')
            ->where('surat_jalan_trx.nomor_sipb', '=', $sipb[0]->nomor_sipb)
            ->get();

        $slip = DB::table('surat_jalan')->get();

        $status_pengiriman = ["Berangkat", "Selesai"];


        return response()->view('schedule.edit', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_jadwal' => $jadwal,
            'data_sipb' => $sipb,
            'data_material' => $material,
            'data_barang_keluar' => $barang_keluar,
            'data_slip' => $slip,
            'status_pengiriman' => $status_pengiriman,
        ]);
    }

    public function doEdit(Request $request)
    {

        # code...

        $status_pengiriman = ($request->tanggal_berangkat == date('Y-m-d')) ? 'Berangkat' : 'dijadwalkan';
        DB::table('jadwal_pengiriman')
            ->where('nomor_pengiriman', '=', $request->id)
            ->update([
                'nomor_slip' => $request->nomor_slip,
                'tanggal_berangkat' => $request->tanggal_berangkat,
                'alamat' => $request->alamat,
                'nomor_kendaraan' => $request->nomor_kendaraan,
                'keterangan' => $request->keterangan,
                'nomor_sipb' => $request->nomor_sipb,
                'status' => $request->status,
            ]);
        if ($request->status == "Selesai") {
            # code...
            DB::table('kurir')->where('nomor_kendaraan','=',$request->nomor_kendaraan)->update([
                'status' => 'Tersedia'
            ]);
        }
        return redirect()->route('tampil jadwal');
    }
}
