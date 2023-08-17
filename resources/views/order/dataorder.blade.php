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
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection