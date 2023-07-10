<?php

namespace App\Http\Controllers;

use App\Models\pemesananM;
use Illuminate\Http\Request;

class jadwalC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = empty($request->cari)?'':$request->cari;

        $user = pemesananM::leftJoin('buktipembayaran', 'buktipembayaran.number', 'pemesanan.number')
        ->join('users', 'users.id','pemesanan.iduser')
        ->join('pakettravel', 'pakettravel.idpakettravel','pemesanan.idpakettravel')
        ->latest()
        ->orderBy('buktipembayaran.uid', 'desc')
        ->where('users.name', 'like', "%$search%")
        ->where('pemesanan.ket',  "3")
        ->select('pemesanan.*', 'users.name', 'users.email','pakettravel.namapaket','pakettravel.hari')
        ->paginate(15);

        $user->appends($request->all());

        return view('jadwal', [
            'user' => $user,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pemesananM  $pemesananM
     * @return \Illuminate\Http\Response
     */
    public function show(pemesananM $pemesananM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemesananM  $pemesananM
     * @return \Illuminate\Http\Response
     */
    public function edit(pemesananM $pemesananM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pemesananM  $pemesananM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pemesananM $pemesananM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemesananM  $pemesananM
     * @return \Illuminate\Http\Response
     */
    public function destroy(pemesananM $pemesananM)
    {
        //
    }
}
