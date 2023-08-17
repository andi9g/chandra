<?php

namespace App\Http\Controllers;

use App\Models\orderM;
use Illuminate\Http\Request;
use App\Models\invoiceM;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\snaptokenM;

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
        
        $invoice = new invoiceM($data);
        $invoice->save();

        $transactionDetails = array(
            'transaction_details' => array(
                'order_id' => $invoice->idinvoice,
                'gross_amount' => (Double)($invoice->total_payment),
            )
        );

        $snapToken = Snap::getSnapToken($transactionDetails);

        $tambahsnap = new snaptokenM([
            "idinvoice" => $invoice->idinvoice,
            "snaptoken" => $snapToken,
        ]);
        
        return redirect('order')->with("success", "Data berhasil ditambahkan");
    }

    public function paymentCallback(Request $request)
    {
        // Proses callback setelah pembayaran sukses/gagal
        // Periksa status pembayaran, lakukan tindakan sesuai kebutuhan
    }
    

    public function calendar(Request $request)
    {
        $keyword = empty($request->tanggal)?date("Y-m-d"):$request->tanggal;
        $tanggal = date("Y-m", strtotime($keyword));

        $data = invoiceM::where("datestart", "like", "$tanggal%")->get();

        
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
