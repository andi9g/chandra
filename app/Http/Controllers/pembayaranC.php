<?php

namespace App\Http\Controllers;

use App\Models\pemesananM;
use App\Models\buktipembayaranM;
use Illuminate\Http\Request;
use App\Models\invoiceM;
use Midtrans\Config;
use Midtrans\Snap;

class pembayaranC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        return view('statuspembayaran');
    }

    public function proses(Request $request)
    {
        $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
        $username = 'chandra.james3219421@gmail.com';
        $password = 'sidldqljfsoldpjn';
        $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
        $emails = imap_search($inbox,'SUBJECT "terima kasih atas pembayaran anda "');


        // ambil 10 email
        // if($emails) {

            $emails = array_slice($emails, -10);
            rsort($emails);
            // dd(count($emails));
            // $content = array();
            foreach($emails as $email) {
                $overview = imap_fetch_overview($inbox, $email, 0);
                $message = imap_fetchbody($inbox, $email, 2);

                $subject = explode(" - ",$overview[0]->subject);
                $number = $subject[2];


                $cek = buktipembayaranM::join('pemesanan', 'pemesanan.number', 'buktipembayaran.number')
                ->where('buktipembayaran.uid', $overview[0]->uid)
                ->where('buktipembayaran.number', $number)
                // ->where('pemesanan.ket', 2)
                ->count();

                // dd(date('Y-m-d H:i:s', strtotime($overview[0]->date)));

                if ($cek == 0) {

                    $pesan = pemesananM::where('number', $number);

                    if($pesan->count() !== 0) {

                        $pesan->update([
                            'ket' => 3,
                        ]);

                        $tambah = new buktipembayaranM;
                        $tambah->uid = $overview[0]->uid;
                        $tambah->number = $number;
                        $tambah->subject = $overview[0]->subject;
                        $tambah->from = $overview[0]->from;
                        $tambah->message = $message;
                        $tambah->date = date('Y-m-d H:i:s', strtotime($overview[0]->date));
                        $tambah->save();
                    }

                }

            // }


        }

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
