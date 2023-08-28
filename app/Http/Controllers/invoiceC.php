<?php

namespace App\Http\Controllers;

use App\Models\invoiceM;
use App\Models\User;
use App\Models\passportM;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\snaptokenM;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleMail;

class invoiceC extends Controller
{
    
    public function showinvoice(Request $request, $invoice_number)
    {
        
        $idinvoice = invoiceM::where("invoice_number", $invoice_number)->first()->idinvoice;

        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');

        $snaptoken = snaptokenM::where("idinvoice", $idinvoice);

        if($snaptoken->count()==0) {
            $invoice = invoiceM::where("idinvoice", $idinvoice)->first();

            $transactionDetails = array(
                'transaction_details' => array(
                    'order_id' => $invoice->idinvoice,
                    'gross_amount' => (Double)($invoice->total_payment),
                ),
                'customer_details' => array(
                    'first_name'       => $invoice->name,
                    'last_name'        => "",
                    'email'            => $invoice->email,
                    'phone'            => $invoice->phone,
                )
            );

            $snapToken = Snap::getSnapToken($transactionDetails);
        
            $tambahsnap = new snaptokenM([
                "idinvoice" => $invoice->idinvoice,
                "snaptoken" => $snapToken,
            ]);
            $tambahsnap->save();
            
            $status = invoiceM::where("idinvoice", $idinvoice)->first()->status;
            $idinvoice = invoiceM::where("idinvoice", $idinvoice)->first()->idinvoice;
            $invoice_number = invoiceM::where("idinvoice", $idinvoice)->first()->invoice_number;
            
        }else {
            $status = invoiceM::where("idinvoice", $idinvoice)->first()->status;
            $idinvoice = invoiceM::where("idinvoice", $idinvoice)->first()->idinvoice;
            $invoice_number = invoiceM::where("idinvoice", $idinvoice)->first()->invoice_number;
            $status = invoiceM::where("idinvoice", $idinvoice)->first()->status;
            $snap = snaptokenM::where("idinvoice", $idinvoice)->first();
            $snapToken = $snap->snaptoken;
        }

        $data = invoiceM::where("idinvoice", $idinvoice)->first();

        return view("umum.show", [
            "snaptoken" => $snapToken,
            "status" => $status,
            "idinvoice" => $idinvoice,
            "invoice_number" => $invoice_number,
            "data" => $data,
        ]);

        // return view("invoice", [
        //     'invoice' => $invoice,
        // ]);
    }

    public function invoice(Request $request)
    {

        return view("umum.invoice");

    }

    public function invoicepost(Request $request)
    {
        $request->validate([
            "invoice_number" => "required",
        ]);

        $invoice_number = $request->invoice_number;

        $cek = invoiceM::where("invoice_number", $invoice_number)->count();

        if($cek > 0 ){
            return redirect('invoice/'.$invoice_number."/show");
        }else {
            return redirect()->back()->with("error", "Sorry, 
            no invoices found")->withInput();
        }
        

    }

    public function tambahpassport(Request $request, $idinvoice)
    {
        
        $request->validate([
            "name" => "required",
            "gambar" => "required",
        ]);

        if($request->hasFile("gambar")) {
            $gambar = $request->gambar;
            $ex = $gambar->getClientOriginalExtension();
            $size = $gambar->getSize();
            $fileName = uniqid().strtotime(now()).".".$ex;

            if($size <= 1000000) {
                if(strtolower($ex) == "jpg" || strtolower($ex) == "jpeg" || strtolower($ex) == "png") {
                    $gambar->move(public_path()."/passport", $fileName);

                    $tambah = new passportM;
                    $tambah->name = $request->name;
                    $tambah->idinvoice = $idinvoice;
                    $tambah->gambar = $fileName;
                    $tambah->save();

                    return redirect()->back()->with("success", "Success")->withInput();

                }
            }
            return redirect()->back()->with("error", "ERROR!")->withInput();
            
            
        }else {
            return redirect()->back()->with("error", "image not found")->withInput();
        }


    }

    public function ordernow(Request $request, $idinvoice)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');

        $snaptoken = snaptokenM::where("idinvoice", $idinvoice);

        if($snaptoken->count()==0) {
            $invoice = invoiceM::where("idinvoice", $idinvoice)->first();

            $transactionDetails = array(
                'transaction_details' => array(
                    'order_id' => $invoice->idinvoice,
                    'gross_amount' => (Double)($invoice->total_payment),
                ),
                'customer_details' => array(
                    'first_name'       => Auth::user()->name,
                    'last_name'        => "",
                    'email'            => Auth::user()->email,
                    'phone'            => Auth::user()->nohp,
                )
            );

            $snapToken = Snap::getSnapToken($transactionDetails);
        
            $tambahsnap = new snaptokenM([
                "idinvoice" => $invoice->idinvoice,
                "snaptoken" => $snapToken,
            ]);
            $tambahsnap->save();
            $status = invoiceM::where("idinvoice", $idinvoice)->first()->status;
            $idinvoice = invoiceM::where("idinvoice", $idinvoice)->first()->idinvoice;
            $invoice_number = invoiceM::where("idinvoice", $idinvoice)->first()->invoice_number;
            
        }else {
            $status = invoiceM::where("idinvoice", $idinvoice)->first()->status;
            $idinvoice = invoiceM::where("idinvoice", $idinvoice)->first()->idinvoice;
            $invoice_number = invoiceM::where("idinvoice", $idinvoice)->first()->invoice_number;
            $status = invoiceM::where("idinvoice", $idinvoice)->first()->status;
            $snap = snaptokenM::where("idinvoice", $idinvoice)->first();
            $snapToken = $snap->snaptoken;
        }

        $data = invoiceM::where("idinvoice", $idinvoice)->first();

        return view("vieworder", [
            "snaptoken" => $snapToken,
            "status" => $status,
            "idinvoice" => $idinvoice,
            "invoice_number" => $invoice_number,
            "data" => $data,
        ]);
        


    }

    public function proses(Request $request, $idinvoice) {
        

        try{
            $update = invoiceM::where('idinvoice', $idinvoice)->update([
                'status' => $request->ket,
            ]);

            return response()->json(['success'=>'Pembayaran berhasil']);;

        }catch(\Throwable $th){
            return response()->json(['success'=>'Terjadi kesalahan']);;
        }
    }

    public function hapuspassport(Request $request, $idpassport)
    {
        
        passportM::where("idpassport", $idpassport)->delete();

        return redirect()->back()->with("success", "success")->withInput();
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
     * @param  \App\Models\invoiceM  $invoiceM
     * @return \Illuminate\Http\Response
     */
    public function show(invoiceM $invoiceM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoiceM  $invoiceM
     * @return \Illuminate\Http\Response
     */
    public function edit(invoiceM $invoiceM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoiceM  $invoiceM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoiceM $invoiceM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoiceM  $invoiceM
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoiceM $invoiceM)
    {
        //
    }
}
