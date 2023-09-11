@extends('layouts.umum')

@section("title", "Invoice")

@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 h-100 mt-2">
        <a href="{{ url('invoice', []) }}" class="btn btn-danger mb-2 btn-block">KEMBALI</a>
        <div class="card p-4" style="background: rgba(255, 255, 255, 0.788);border-radius: 20px">
           
            <form action="{{ route('ordernow.store', []) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" required class="form-control"  type="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="customer-name">Customer Name</label>
                        <input id="customer-name" required class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label for="customer-name">Phone</label>
                        <input id="customer-name" required class="form-control" type="number" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="customer-accomodation">Accomodation & Vessel</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input id="customer-accomodation" required class="form-control" type="text" name="accomodation">
                            </div>
                            <div class="col-md-6">
                                <input id="customer-accomodation" required class="form-control" type="text" name="vessel">
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label for="date-oftravel">DATE OF TRAVEL</label>
                        <div class="row">
                            <div class="col-4">
                                <label for="">Date Start</label>
                            </div>
                            <div class="col-8">
                                <input id="date-oftravel" required class="form-control rounded-0" type="date" name="datestart">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <label for="">Date End</label>
                            </div>
                            <div class="col-8">
                                <input id="date-oftravel" required class="form-control rounded-0" type="date" name="dateend">

                            </div>
                        </div>
                        
                    </div>

                   
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">PROCESS</button>
                </div>

            </form>
                
        </div>
        <br>

        

        
    </div>
</div>
@endsection