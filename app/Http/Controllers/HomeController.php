<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //

    public function index(Request $request)
    {
        $sipb_approve = DB::table('sipb')->selectRaw('count(status) as setuju')->where('status','=','setujui')->get();
        $sipb_pending = DB::table('sipb')->selectRaw('count(status) as pending')->where('status','=','belum disetujui')->get();
        $sipb_reject = DB::table('sipb')->selectRaw('count(status) as reject')->where('status','=','tolak')->get();
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $jumlah_tolak = DB::table('sipb')
            ->select(DB::raw("COUNT(status) as jumlah_tolak"))
            ->where('status', '=', 'tolak')
            ->get();
        $jumlah_setuju = DB::table('sipb')
            ->select(DB::raw("COUNT(status) as jumlah_setuju"))
            ->where('status', '=', 'setuju')
            ->get();
        return view('home', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'jumlah_tolak' => $jumlah_tolak,
            'jumlah_setuju' => $jumlah_setuju,
            'data_setuju' => $sipb_approve,
            'data_pending' => $sipb_pending,
            'data_reject' => $sipb_reject,
        ]);
    }
}
