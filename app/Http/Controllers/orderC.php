<?php

namespace App\Http\Controllers;

use App\Models\orderM;
use Illuminate\Http\Request;
use App\Models\invoiceM;
use App\Models\User;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\snaptokenM;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleMail;
use Hash;
use PDF;

class orderC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?"":$request->keyword;

        $data = invoiceM::latest()->where("name", "like", "%$keyword%")->paginate(10);

        $data->appends($request->only(["limit", "keyword"]));

        
        return view("order.dataorder", [
            "order" => $data,
        ]);
    }

    public function order()
    {
        return view("order.tambahorder");
    }


    public function editorder(Request $request, $idinvoice)
    {
        $data = $request->all();
        $update = invoiceM::where("idinvoice", $idinvoice)->first();
        $update->update($data);

        return redirect()->back()->with("success", "Success")->withInput();
    }

    

    public function createorder(Request $request)
    {
        
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        
        // dd(config('midtrans.server_key'));
        // Simpan detail invoice dan orang yang akan membayar ke database
        $data = $request->all();
        $data["invoice_number"] =  'INV' . date('YmdHis');
        $data["status"] = "pending";
        $data["idinvoice"] = strtotime(date("Y-m-d H:i:s"));
        
        $invoice = new invoiceM($data);
        $invoice->save();

        $transactionDetails = array(
            'transaction_details' => array(
                'order_id' => $invoice->idinvoice,
                'gross_amount' => (Double)($invoice->total_payment),
            )
        );


        $cek = User::where('email', $request->email)->count();
        $email = $request->email;
        $name = $request->name;
        $phone = $request->phone;
        $link = url("/invoice/".$invoice->invoice_number."/show");

        

        $mailData = [
            'title' => 'Travel Order',
            'content' => 'thank you for trusting our travel, here is the account information we have provided',
            'email' => $email,
            'invoice_number' => $invoice->invoice_number,
            'total_payment' => $invoice->total_payment,
            'accomodation' => $invoice->accomodation,
            'vessel' => $invoice->vessel,
            'datestart' => $invoice->datestart,
            'dateend' => $invoice->dateend,
            'link' => $link,
        ];
        
        Mail::to($email)
            ->send(new SampleMail($mailData));

        
        return redirect('order')->with("success", "Data berhasil ditambahkan");
    }

    public function hapus(Request $request, $idinvoice)
    {
        invoiceM::destroy($idinvoice);
        return redirect()->back()->with("success", "Invoice berhasil dihapus")->withInput();
    }
    
    public function paymentCallback(Request $request)
    {
        // Proses callback setelah pembayaran sukses/gagal
        // Periksa status pembayaran, lakukan tindakan sesuai kebutuhan
    }

    public function cetak(Request $request)
    {
        $datestart = $request->datestart;
        $dateend = $request->dateend;

        if(date("Y-m", strtotime($datestart)) == date("Y-m", strtotime($dateend))) {
            $bulan = date("F", strtotime($datestart));
        }else {
            $bulan = date("F", strtotime($datestart))." to ".date("F", strtotime($dateend));
        }

        $data = invoiceM::whereBetween("created_at", [$datestart, $dateend])->get();

        $pdf = PDF::loadView("laporan.order", [
            "data" => $data,
            "datestart" => $datestart,
            "dateend" => $dateend,
            "bulan" => $bulan,
        ]);

        return $pdf->stream("laporan.pdf");
    }


    
    public function konfirmasi(Request $request, $idinvoice)
    {
        $data = $request->all();
        $update = invoiceM::where("idinvoice", $idinvoice)->first();
        $update->update($data);
        return redirect()->back()->with("success", "KONFIRMASI BERHASIL")->withInput();
    }

    public function calendar(Request $request)
    {
        $keyword = empty($request->tanggal)?date("Y-m-d"):$request->tanggal;
        $tanggal = date("Y-m", strtotime($keyword));

        $data = invoiceM::where("status", "success")->where("datestart", "like", "$tanggal%")->get();

        
        return view("order.calendar", [
            "keyword" => $keyword,
            "data" => $data,
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
     * @param  \App\Models\orderM  $orderM
     * @return \Illuminate\Http\Response
     */
    public function show(orderM $orderM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orderM  $orderM
     * @return \Illuminate\Http\Response
     */
    public function edit(orderM $orderM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orderM  $orderM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orderM $orderM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orderM  $orderM
     * @return \Illuminate\Http\Response
     */
    public function destroy(orderM $orderM)
    {
        //
    }
}
