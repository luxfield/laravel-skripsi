<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kurirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //todo
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $data_kurir = DB::table('kurir')->get();
        return response()->view('courier', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'data_kurir' => $data_kurir,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        return response()->view('courier.create',[
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        DB::table('kurir')->insert(
            [
                'nomor_kendaraan' => $request->nomor_kendaraan,
                'nama_pengemudi' => $request->nama_pengemudi,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'status' => $request->status,

            ]
        );
        return response()->redirectToRoute('kurir.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return response('hillo');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //
        $user = DB::table('users')->where('email', '=', $request->session()->get('user'))->get();
        $data_kurir = DB::table('kurir')->where('nomor_kendaraan', '=', $id)->get();
        return response()->view('courier.edit', [
            'title' => $user[0]->name,
            'email_user' => $user[0]->email,
            'role' => $user[0]->role,
            'title' => 'Edit Kurir',
            'data_kurir' => $data_kurir
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        DB::table('kurir')->where('nomor_kendaraan','=', $id)->update(
            [
                'nama_pengemudi' => $request->nama_pengemudi,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'status' => $request->status,

            ]
        );
        return response()->redirectToRoute('kurir.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //todo
        // var_dump($id);
        DB::table('kurir')->where('nomor_kendaraan','=',$id)->delete();

        return response()->redirectToRoute('kurir.index');

    }
}
