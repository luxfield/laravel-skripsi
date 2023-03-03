<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SIPBGudangController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $sipb = DB::table('sipb')->get();
        if (count($sipb) == 0) {
            # code...
            $sipb = [];
            $pelanggan = [];
        } else {
            $pelanggan = DB::table('pelanggan')->where('id_pelanggan', '=', $sipb[0]->id_pelanggan)->get();

        }

        return response()->view('staff_gudang.index', [
            'pelanggan' => $pelanggan,
            "data_sipb" => $sipb ,
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,

        ]);
    }

    public function detail_sipb(Request $request, String $id)
    {
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $sipb = DB::table('sipb')->where('nomor_sipb', '=', $id)->get();
        $material = DB::table('surat_jalan_trx')
            ->join('data_barang', 'surat_jalan_trx.nomor_material', '=', 'data_barang.kode_material')
            ->where('surat_jalan_trx.nomor_sipb', '=', $sipb[0]->nomor_sipb)
            ->get();
        $pelanggan = DB::table('pelanggan')->where('id_pelanggan', '=', $sipb[0]->id_pelanggan)->get();
        return response()->view('staff_gudang.letter.detail', [
            "data_sipb" => $sipb,
            "data_material" => $material,
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_pelanggan' => $pelanggan
        ]);
    }

    public function detail_sipb_proses(Request $request, String $id)
    {
        $data_slip = DB::table('surat_jalan')
            ->select('nomor_slip')
            ->orderByDesc('nomor_slip')
            ->limit(1)
            ->get();


        if (count($data_slip) == 0) {
            $nomor_slip = '001/SLIP/' . date('m') . '/' . date('Y');
        } else {
            $nomor_urut = substr($data_slip[0]->nomor_slip, 0, 3);
            $nomor_urut = intval($nomor_urut) + 1;

            if ($nomor_urut < 10) {
                $nomor_slip = '00' . $nomor_urut . '/SLIP/' . date('m') . '/' . date('Y');
            } elseif ($nomor_urut < 100) {
                $nomor_slip = '0' . $nomor_urut . '/SLIP/' . date('m') . '/' . date('Y');
            } else {
                $nomor_slip = $nomor_urut . '/SLIP/' . date('m') . '/' . date('Y');
            }
        }



        if ($request->status == "tolak") {
            # code...
            DB::table('sipb')->where('nomor_sipb', '=', $request->nomor_sipb)->update([
                'status' => $request->status
            ]);
            session()->flash('sipb_reject',$request->keterangan);
            return redirect()->route('sipb');
        } else {

            DB::table('surat_jalan')->insert([
                'nomor_slip' => $nomor_slip,
                'nomor_sipb' => $request->nomor_sipb,
                'tanggal' => date('Y-m-d'),
                'alamat' => $request->alamat,
                'keterangan' => $request->keterangan,
            ]);

            DB::table('sipb')->where('nomor_sipb', '=', $request->nomor_sipb)->update([
                'status' => $request->status
            ]);
            $this->add_proses($nomor_slip);
            session()->flash('sipb_approve','sipb disetujui');
            return redirect()->route('sipb');
        }
        return redirect()->route('sipb');
    }

    private function add_proses(String $nomor_slip)
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

        $slip = DB::table('surat_jalan')->where('nomor_slip', '=', $nomor_slip)->get();
        $sipb = DB::table('sipb')->where('nomor_sipb', '=', $slip[0]->nomor_sipb)->get();
        $data_sipb_material = DB::table('surat_jalan_trx')->where('nomor_sipb', '=', $sipb[0]->nomor_sipb)->get();
        $pelanggan = DB::table('pelanggan')->where('id_pelanggan', '=', $sipb[0]->id_pelanggan)->get();

        $status_pengiriman = 'Berangkat';

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
            'nomor_slip' => $nomor_slip,
            'perusahaan' => $pelanggan[0]->nama_perusahaan,
            'nama_penerima' => $sipb[0]->nama_penerima,
            'tanggal_berangkat' => date('Y-m-d'),
            'alamat' => $pelanggan[0]->alamat,
            'jarak' => $pelanggan[0]->jarak,
            'estimasi' => strval($total_sjf),
            'nomor_kendaraan' => $sipb[0]->nomor_kendaraan,
            'keterangan' => $sipb[0]->keterangan,
            'nomor_sipb' => $sipb[0]->nomor_sipb,
            'status' => $status_pengiriman
        ]);

        DB::table('kurir')->where('nomor_kendaraan', '=', $sipb[0]->nomor_kendaraan)->update([
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

    public function confirmed_slip(Request $request)
    {
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $sipb = DB::table('sipb')->where('nomor_sipb', '=', $request->id)->get();
        $barang = DB::table('surat_jalan')->where('nomor_sipb', '=', $request->id)->get();

        // $material = DB::table('surat_jalan_trx')->where('nomor_sipb','=', $barang[0]->nomor_sipb)->get();
        $material = DB::table('surat_jalan_trx')
            ->join('data_barang', 'surat_jalan_trx.nomor_material', '=', 'data_barang.kode_material')
            ->where('surat_jalan_trx.nomor_sipb', '=', $sipb[0]->nomor_sipb)
            ->get();
        return response()->view('staff_gudang.letter.confirmed', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            "data_sipb" => $sipb,
            "data_slip" => $barang,
            "data_material" => $material,

        ]);
    }

    public function sipb_disetujui(Request $request)
    {
        # code...
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $sipb = DB::table('sipb')->where('status', '=', 'setujui')->get();
        return response()->view('staff_gudang.sipb.approve.article', [
            "data_sipb" => $sipb,
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,

        ]);
    }
    public function sipb_pending(Request $request)
    {
        # code...
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $sipb = DB::table('sipb')->where('status', '=', 'belum disetujui')->get();
        if (count($sipb) == 1) {
            # code...
            $pelanggan = DB::table('pelanggan')->where('id_pelanggan','=',$sipb[0]->id_pelanggan)->get();
        }
        else {
            $pelanggan = [];
            $sipb = [];
        }
        return response()->view('staff_gudang.sipb.pending.article', [
            'pelanggan' => $pelanggan,
            "data_sipb" => $sipb,
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,

        ]);
    }
    public function sipb_ditolak(Request $request)
    {
        # code...
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $sipb = DB::table('sipb')->where('status', '=', 'tolak')->get();
        return response()->view('staff_gudang.sipb.reject.article', [
            "data_sipb" => $sipb,
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,

        ]);
    }
}
