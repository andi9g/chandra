<?php

namespace App\Http\Controllers;

use App\Models\invoiceM;
use Illuminate\Http\Request;

class homeC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $success = invoiceM::where("status", "success")->count(); 
        $fail = invoiceM::where("status", "fail")->count(); 
        $pending = invoiceM::where("status", "pending")->count(); 

        return view("home", [
            "success" => $success,
            "fail" => $fail,
            "pending" => $pending,
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
