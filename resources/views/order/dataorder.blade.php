@extends('layouts.master')

@section("judul", "Data Order")
@section("warnaorder", "active")

@section('content')
<div id="cetak" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="my-modal-title">Print</h5>
        <button class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('cetak.order', []) }}" method="GET">
      
        <div class="modal-body">
          <div class="form-group">
            <label for="datestart">Date Start</label>
            <input id="datestart" class="form-control" type="date" name="datestart">
          </div>
  
          <div class="form-group">
            <label for="dateend">Date End</label>
            <input id="dateend" class="form-control" type="date" name="dateend">
          </div>

          <div class="form-group d-inline">
            <label for="status">Status</label>
            <select id="status" class="form-control" name="status">
              <option value="">Semua Status</option>
              <option value="pending" @if ($status == "pending")
                  selected
              @endif>Pending</option>
              <option value="success" @if ($status == "success")
                  selected
              @endif>Success</option>
              <option value="fail" @if ($status == "fail")
                  selected
              @endif>Cancel</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Print</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-7">
                <form action="{{ route('tambah.order', []) }}" method="get">
                  <button type="submit" class="btn btn-primary">
                      Tambah Data Order
                  </button>
                  
              </form>
              </div>
              <div class="col-md-5 text-right d-inline-block">
                <div class="row">
                  <div class="col-md-8">
                    <form action="{{ url()->current() }}" class="d-inline">
                      <div class="form-group d-inline">
                        <select id="status" class="form-control" onchange="submit()" name="status">
                          <option value="">Semua Status</option>
                          <option value="pending" @if ($status == "pending")
                              selected
                          @endif>Pending</option>
                          <option value="success" @if ($status == "success")
                              selected
                          @endif>Success</option>
                          <option value="fail" @if ($status == "fail")
                              selected
                          @endif>Cancel</option>
                        </select>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-4">
                    <button class="btn btn-secondary btn-block d-inline" type="button" data-toggle="modal" data-target="#cetak">
                      <i class="fa fa-print"></i> Cetak
                    </button>
                  </div>
                </div>
                

               
                  
                {{-- <div class="input-group">
                  <input type="text" class="form-control" placeholder="Recipient's name" aria-label="Recipient's username" name="keyword" aria-describedby="button-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Cari</button>
                  </div>
                </div> --}}
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
                  <th rowspan="2">Vessel</th>
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
                      <td>{{ $data->vessel }}</td>
                      <td>{{ $data->datestart }}</td>
                      <td>{{ $data->dateend }}</td>
                      <td>{{ $data->status }}</td>
                      <td>{{ number_format($data->total_payment, 0, ",",".") }}</td>
                      <td>
                        @if ($data->status != "success")
                        <form action="{{ route('hapus.order', [$data->idinvoice]) }}" method="post">
                          @csrf
                          @method("DELETE")
                          <button type="submit" onclick="return confirm('yakin ingin dihapus?')" class="badge badge-danger border-0 py-1">
                            <i class="fa fa-trash"></i> Cancel
                          </button>
                        </form>
                            
                        @endif

                        <a class="badge border-0 py-1 badge-info" href="{{ route('order.show', [$data->idinvoice]) }}" >
                          <i class="fa fa-edit"></i> Edit
                        </a>
                      </td>

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