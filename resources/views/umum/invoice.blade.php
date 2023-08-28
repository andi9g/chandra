@extends('layouts.umum')

@section("title", "Invoice")

@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 h-100 mt-5 pt-5">
        <div class="card p-4" style="background: rgba(255, 255, 255, 0.788);border-radius: 20px">
            <div class="card-body text-center ">
                <h3>INPUT INVOICE NUMBER</h3>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="{{ route('show.invoice', []) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input id="my-input" value="{{ empty($_GET['key'])?'':$_GET['key'] }}" class="form-control bg-light py-4 text-center" type="text" name="invoice_number">
                            </div>
                            <button type="submit" class="btn btn-danger btn-block">
                                PAYMENT
                            </button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
        <br>

        
    </div>
</div>
@endsection