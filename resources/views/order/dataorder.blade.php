@extends('layouts.master')

@section("judul", "Data Order")
@section("warnaorder", "active")

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-8">
                <form action="{{ route('tambah.order', []) }}" method="get">
                  <button type="submit" class="btn btn-primary">
                      Tambah Data Order
                  </button>
              </form>
              </div>
              <div class="col-md-4">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Recipient's name" aria-label="Recipient's username" name="keyword" aria-describedby="button-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Cari</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <table class="table table-striped table-hover table-sm table-bordered">
              <thead>
                <tr>
                  <th rowspan="2">No</th>
                  <th rowspan="2">Invoice Number</th>
                  <th rowspan="2">Customer Name</th>
                  <th rowspan="2">Accomodation</th>
                  <th class="text-center" colspan="2">Date of Travel</th>
                  <th rowspan="2">Payment Status</th>
                  <th rowspan="2">Price</th>
                  <th rowspan="2">Action</th>

                </tr>
                <tr>
                  <th>Date Start</th>
                  <th>Date end</th>
                </tr>

              </thead>

              <tbody>
                
                @foreach ($order as $data)
                    <tr>
                      <td>{{ $loop->iteration + $order->firstItem() - 1 }}</td>
                      <td>{{ $data->invoice_number }}</td>
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->accomodation }}</td>
                      <td>{{ $data->datestart }}</td>
                      <td>{{ $data->dateend }}</td>
                      <td>{{ $data->status }}</td>
                      <td>{{ number_format($data->total_payment, 0, ",",".") }}</td>
                      <td>
                        <button type="submit" class="badge badge-danger border-0 py-1">
                          <i class="fa fa-trash"></i> Cancel
                        </button>

                        <button class="badge border-0 py-1 badge-info" type="button" data-toggle="modal" data-target="#ubahInvoice{{ $data->idinvoice }}">
                          <i class="fa fa-edit"></i> Edit
                        </button>
                      </td>

                    </tr>

                    <div id="ubahInvoice{{ $data->idinvoice }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="my-modal-title">Ubah Data</h5>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{ route('order.edit.order', [$data->idinvoice]) }}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="modal-body">
                              <div class="form-group">
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
                              </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success">Edit</button>
                            </div>
                          
                          </form>
                        </div>
                      </div>
                    </div>

                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection