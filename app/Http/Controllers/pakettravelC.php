<?php

namespace App\Http\Controllers;

use App\Models\pakettravelM;
use App\Models\pemesananM;
use Illuminate\Http\Request;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Services\Midtrans\Midtrans;
use Auth;

class pakettravelC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pakettravel = pakettravelM::get();
        return view('pakettravel', [
            'pakettravel' => $pakettravel,
        ]);
    }

    public function pemesanan(Request $request,$idpakettravel) {
        $request->validate([
            'tanggalmulai'=>'required'
        ], [
            'required' => 'Tangal mulai harus diisi!'
        ]);

        try{
            $hari = pakettravelM::where('idpakettravel', $idpakettravel)->first();
            $iduser = Auth::user()->id;

            $tanggalmulai = $request->tanggalmulai;
            $tanggalselesai = date('Y-m-d', strtotime('+'.$hari->hari.'days', strtotime($request->tanggalmulai)));
            $ket = '1';

            $tambah = new pemesananM;
            $tambah->number = date('YmdHis');
            $tambah->idpakettravel = $idpakettravel;
            $tambah->iduser = $iduser;
            $tambah->tanggalmulai = $tanggalmulai;
            $tambah->tanggalselesai = $tanggalselesai;
            $tambah->ket = $ket;
            $tambah->save();

            if ($tambah) {
                return redirect('pakettravel/pesanan/'.$idpakettravel)->with('success', 'Pemesanan telah dilakukan');
            }


        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }


    }

    public function pesanan(Request $request, $idpakettravel) {

        $id = Auth::user()->id;
        $pesanan = pemesananM::join('pakettravel', 'pakettravel.idpakettravel', 'pemesanan.idpakettravel')
        ->select('pakettravel.*', 'pemesanan.*')
        ->where('iduser', $id)
        ->where('pakettravel.idpakettravel', $idpakettravel)->get();
        $judul = pakettravelM::where('idpakettravel', $idpakettravel)->first();
        return view('pesanan', [
            'pesanan' => $pesanan,
            'judul' => $judul,
            'idpakettravel' => $idpakettravel,
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
     * @param  \App\Models\pakettravelM  $pakettravelM
     * @return \Illuminate\Http\Response
     */
    public function show(pakettravelM $pakettravelM, $idpemesanan)
    {

        $ambil = pemesananM::where('pemesanan.idpemesanan', $idpemesanan)->first();
        $pesanan = pemesananM::join('pakettravel', 'pakettravel.idpakettravel', 'pemesanan.idpakettravel')
        ->select('pakettravel.*', 'pemesanan.*')
        ->where('pemesanan.idpemesanan', $idpemesanan)
        ->first();
        $judul = "INVOICE";
        $idpakettravel = $pesanan->idpakettravel;
        $snapToken = $pesanan->snap_token;

        $status = "none";

        if (is_null($snapToken)) {


            $midtrans = new CreateSnapTokenService($pesanan);
            $snapToken = $midtrans->getSnapToken();



            $ambil->snap_token = $snapToken;
            $ambil->save();
        }


        $pesanan = pemesananM::join('pakettravel', 'pakettravel.idpakettravel', 'pemesanan.idpakettravel')
        ->select('pakettravel.*', 'pemesanan.*')
        ->where('pemesanan.idpemesanan', $idpemesanan)
        ->first();

        return view('show', compact('pesanan', 'snapToken', 'judul', 'idpakettravel'));
    }

   public function proses(Request $request, $idpemesanan)
   {
        $request->validate([
            'ket'=>'required'
        ]);

        try{
            $ket = $request->ket;

            $update = pemesananM::where('idpemesanan', $idpemesanan)->update([
                'ket' => $ket,
            ]);

            return response()->json(['success'=>'Pembayaran berhasil']);;

        }catch(\Throwable $th){
            return response()->json(['success'=>'Terjadi kesalahan']);;
        }
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pakettravelM  $pakettravelM
     * @return \Illuminate\Http\Response
     */
    public function edit(pakettravelM $pakettravelM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pakettravelM  $pakettravelM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pakettravelM $pakettravelM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pakettravelM  $pakettravelM
     * @return \Illuminate\Http\Response
     */
    public function destroy(pakettravelM $pakettravelM)
    {
        //
    }
}
