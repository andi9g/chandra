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
class ordernowC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("umum.ordernow");
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
        
        $data = $request->all();
        $data["invoice_number"] =  'INV' . date('YmdHis');
        $data["status"] = "pending";
        $data["idinvoice"] = strtotime(date("Y-m-d H:i:s"));
        
        $invoice = new invoiceM($data);
        $invoice->save();
        
        return redirect()->back()->with("success", "Data berhasil ditambahkan, <br> Silahkan menunggu admin melakukan pengecekan dan pemberitahuan pembayaran melalui E-Mail");
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
