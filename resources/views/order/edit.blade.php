@extends('layouts.master')

@section("judul", "Data Order")
@section("warnaorder", "active")

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <a href="{{ url('order', []) }}" class="btn btn-danger">Kembali</a>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <h3>FORM EDIT</h3>
        </div>
        <form action="{{ route('order.edit.order', [$data->idinvoice]) }}" method="post">
          @csrf
          @method("PUT")
          <div class="card-body">
              <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" class="form-control" type="email" name="email" value="{{ $data->email }}">
              </div>

              <div class="form-group">
                  <label for="customer-name">Customer Name</label>
                  <input id="customer-name" class="form-control" type="text" name="name" value="{{ $data->name }}">
              </div>

              <div class="form-group">
                  <label for="customer-accomodation">Accomodation & Vessel</label>
                  <div class="row">
                      <div class="col-md-6">
                          <input id="customer-accomodation" class="form-control" type="text" name="accomodation" value="{{ $data->accomodation }}">
                      </div>
                      <div class="col-md-6">
                          <input id="customer-accomodation" class="form-control" type="text" name="vessel" value="{{ $data->vessel }}">
                      </div>
                  </div>
                  
              </div>

              <div class="form-group">
                  <label for="date-oftravel">DATE OF TRAVEL</label>
                  <div class="row">
                      <div class="col-2">
                          <label for="">Date Start</label>
                      </div>
                      <div class="col-10">
                          <input id="date-oftravel" class="form-control rounded-0" type="date" name="datestart" value="{{ $data->datestart }}">

                      </div>
                  </div>

                  <div class="row">
                      <div class="col-2">
                          <label for="">Date End</label>
                      </div>
                      <div class="col-10">
                          <input id="date-oftravel" class="form-control rounded-0" type="date" name="dateend" value="{{ $data->dateend }}">

                      </div>
                  </div>
                  
              </div>

              <div class="form-group">
                  <label for="total-payment">Total Payment</label>
                  <input id="total-payment" class="form-control" type="number" name="total_payment" value="{{ $data->total_payment }}">
              </div>

              <div class="form-group">
                  <label for="customer-phone">Phone Number</label>
                  <input id="customer-phone" class="form-control" type="number" name="phone" value="{{ $data->phone }}">
              </div>

              <div class="form-group">
                  <label for="customer-note">Note</label>
                  <textarea name="note" name="note" id="customer-note" class="form-control" rows="3">{{ $data->note }}</textarea>
              </div>

              <div class="form-group">
                <label for="customer-confirmation">Confirmation</label>
                <textarea name="confirmation" name="confirmation" id="customer-confirmation" class="form-control" rows="3">{{ $data->confirmation }}</textarea>
              </div>
              <div class="form-group">
                  <label for="customer-tiket">Vessel Tiket</label>
                  <input id="customer-tiket" class="form-control" type="text" name="tiket" value="{{ $data->tiket }}">
              </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Edit</button>
          </div>
        </form>

      </div>

    </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="card-body">
            
        </div>
        </div>
      </div>
      
    
    </form>
  </div>
</div>
@endsection