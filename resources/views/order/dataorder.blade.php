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
                          <div class="modal-body">
                            edit data
                          </div>
                          <div class="modal-footer">
                            Footer
                          </div>
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