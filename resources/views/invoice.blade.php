@extends('layouts.master')

@section('warnainvoice', 'active')
@section('judul', 'Data Invoice')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($invoice as $item)
        @php
            $status = $item->status;
            if($status == "success") {
                $warna = "bg-success";
                $ket = "PAYMENT DETAIL";
            }else if($status == "pending") {
                $warna = "bg-warning";
                $ket = "PAY NOW";
            }else {
                $warna = "bg-danger";
                $ket = "EXPIRED";
            }

        @endphp
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header text-center {{ $warna }}">
                    <h3 class="my-0 py-0">{{ $item->invoice_number }}</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('order.now', [$item->idinvoice]) }}" class="btn btn-block {{ $warna }}"> <b>{{ $ket }}</b></a>

                    <hr>
                    
                    <button class="btn btn-primary d-inline" type="button" data-toggle="modal" data-target="#tambahpassport{{ $item->idinvoice }}">INPUT</button>
                    <p class="d-inline">Your Passport Detail Here</p>
                    <br>
                    <br>
                    
                    <table class="table table-sm table-striped table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </thead>
                        @php
                            $data = DB::table("passport")->where("email", Auth::user()->email)
                            ->where("idinvoice", $item->idinvoice)->get();
                        @endphp
                        @foreach ($data as $d)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucwords($d->name) }}</td>
                                <td>
                                    <button class="badge border-0 py-1 badge-info" type="button" data-toggle="modal" data-target="#gambar{{ $d->idpassport }}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                                <td>
                                    <form action="{{ route('hapus.passport', [$d->idpassport]) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('are you sure?')" class="badge badge-danger border-0 py-1">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                    <button class="badge border-0 py-1 badge-primary d-inline" type="button" data-toggle="modal" data-target="#ubah{{ $d->idpassport }}">
                                    <i class="fa fa-edit"></i>
                                    </button>

                                </td>
                            </tr>
                        </tbody>

                        <div id="ubah{{ $d->idpassport }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ubahpassport" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ubahpassport">Change Data</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="inputname">Customer Name</label>
                                            <input id="inputname" class="form-control" type="text" name="name" value="{{ $d->name }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">
                                            Update Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="gambar{{ $d->idpassport }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalgambar" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalgambar">Passport Image</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ url('/passport', [$d->gambar]) }}" width="100%" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        @endforeach


                    </table>
                </div>
            </div>
        </div>


        
        <div id="tambahpassport{{ $item->idinvoice }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahpassport" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahpassport">Input Passport Data</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('tambah.passport', [$item->idinvoice]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputname">Customer Name</label>
                                <input id="inputname" class="form-control" type="text" name="name">
                            </div>
                            <div class="form-group">
                                <label for="inputinvoice">Invoice Number</label>
                                <input id="inputinvoice" disabled readonly class="form-control" type="text" value="{{ $item->invoice_number }}">
                            </div>
    
                            <div class="form-group">
                                <label for="inputfile">Passport Picture </label>
                                <input id="inputfile" class="form-control" type="file" name="gambar">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">
                                Add Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            
        @endforeach
    </div>

</div>



@endsection




