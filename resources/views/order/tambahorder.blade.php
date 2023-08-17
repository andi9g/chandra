@extends('layouts.master')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="my-0 py-1">New Order</h3>
                    </div>
                    <form action="{{ route('order.create.order', []) }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" class="form-control" type="email" name="email">
                            </div>
    
                            <div class="form-group">
                                <label for="customer-name">Customer Name</label>
                                <input id="customer-name" class="form-control" type="text" name="name">
                            </div>
    
                            <div class="form-group">
                                <label for="customer-accomodation">Accomodation & Vessel</label>
                                <input id="customer-accomodation" class="form-control" type="text" name="accomodation">
                            </div>
    
                            <div class="form-group">
                                <label for="date-oftravel">DATE OF TRAVEL</label>
                                <div class="row">
                                    <div class="col-2">
                                        <label for="">Date Start</label>
                                    </div>
                                    <div class="col-10">
                                        <input id="date-oftravel" class="form-control rounded-0" type="date" name="datestart">
    
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-2">
                                        <label for="">Date End</label>
                                    </div>
                                    <div class="col-10">
                                        <input id="date-oftravel" class="form-control rounded-0" type="date" name="dateend">
    
                                    </div>
                                </div>
                                
                            </div>
    
                            <div class="form-group">
                                <label for="total-payment">Total Payment</label>
                                <input id="total-payment" class="form-control" type="number" name="total_payment">
                            </div>
    
                            <div class="form-group">
                                <label for="customer-phone">Phone Number</label>
                                <input id="customer-phone" class="form-control" type="number" name="phone">
                            </div>
    
                            <div class="form-group">
                                <label for="customer-note">Note</label>
                                <textarea name="note" name="note" id="customer-note" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection