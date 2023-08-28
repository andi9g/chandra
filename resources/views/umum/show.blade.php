@extends('layouts.umum')

{{-- @section('judul', $invoice_number) --}}


@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
@php
    if($status == "pending") {
        $atas = "card-warning";
        $text = "text-warning";
    }else if($status == "success"){
        $atas = "card-success";
        $text = "text-success";
    }else {
        $atas = "card-danger";
        $text = "text-danger";
    }
@endphp

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 mt-5">
        
        <div class="card card-outline {{ $atas }}" style="background: rgba(255, 255, 255, 0.89)">
            <div class="card-title">
                <a href="{{ url('invoice', []) }}" class="btn btn-danger btn-sm m-2">Back</a>
            </div>
            <div class="card-body {{ $text }} text-center">
                @if ($status=="pending")
                    <h3>Your payment status is pending, please make a payment</h3>
                    <br>
                    <button class="btn btn-primary " id="pay-button"><b>PAY NOW</b></button>
                    <br>
                    <br>
                    <p class="text-dark">payment will end within 24 hours</p>
                

                @elseif($status == "success")
                    @if ($data->confirmation == null)
                    <h3>TERIMA KASIH! <br> PEMBAYARAN ANDA SEDANG DIPROSES</h3>
                    <h4 class="text-dark">SILAHKAN MENUNGGU KONFIRMASI <br>DALAM WAKTU 1X24 JAM</h4>
                
                    @else
                    <h3>THANKYOU FOR YOUR VALUEABLE <br> SUPPORT</h3>
                    <table class="table table-striped text-lg text-dark">
                        <tr>
                            <td>INVOICE NUMBER</td>
                            <td>:</td>
                            <td>{{ $invoice_number }}</td>
                        </tr>
                        <tr>
                            <td>CUSTOMER NAME</td>
                            <td>:</td>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>

                        <tr>
                            <td>ACCOMODATION & VESSEL</td>
                            <td>:</td>
                            <td>{{ $data->accomodation." & ".$data->vessel}}</td>
                        </tr>
                        <tr>
                            <td>EMAIL</td>
                            <td>:</td>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <td>HOTEL CONFIRMATION</td>
                            <td>:</td>
                            <td>{{$data->confirmation }}</td>
                        </tr>

                        <tr>
                            <td>VESSEL TICKET</td>
                            <td>:</td>
                            <td>{{$data->tiket }}</td>
                        </tr>

                    </table>

                    @endif



                    <div class="card p-4" style="background: rgba(230, 230, 230, 0.747);border-radius: 20px">
                        <div class="card-body text-center ">
                            <button class="btn btn-primary d-inline" type="button" data-toggle="modal" data-target="#tambahpassport{{ $idinvoice }}">INPUT</button>
                            <p class="d-inline">Your Passport Detail Here</p>
                            <br>
                            <br>
                            
                            <table class="table table-sm table-striped table-bordered">
                                <thead class="bg-secondary">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </thead>
                                @php
                                    $data = DB::table("passport")->where("idinvoice", $idinvoice)->get();
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
                
                @else 
                    <h3>MAAF!!</h3>
                    <h3>NO INVOICE ANDA TELAH EXPIRED</h3>
                        <br>
                    <h4 class="text-dark">
                        MOHON HUBUNGI KEMBALI KE TRAVEL AGENCY TERKAIT
                    </h4>
                @endif
            </div>
        </div>
    </div>
</div>
   


<div id="tambahpassport{{ $idinvoice }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahpassport" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahpassport">Input Passport Data</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tambah.passport', [$idinvoice]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputname">Customer Name</label>
                        <input id="inputname" class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label for="inputinvoice">Invoice Number</label>
                        <input id="inputinvoice" disabled readonly class="form-control" type="text" value="{{ $invoice_number }}">
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



@endsection


@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

<script>

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();

        snap.pay('{{ $snaptoken }}', {
            // Optional
            onSuccess: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                var ket = 'success';
                $.ajax({
                    type:'POST',
                    url:"{{ route('ajax.post', $idinvoice) }}",
                    data:{ket:ket},
                    success:function(data){
                        alert(data.success);
                        location.reload();
                    }
                });
            },
            // Optional
            onPending: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log(result)
            },
            // Optional
            onError: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                var ket = 'fail';
                $.ajax({
                    type:'POST',
                    url:"{{ route('ajax.post', $idinvoice) }}",
                    data:{ket:ket},
                    success:function(data){
                        alert(data.success);
                        location.reload();
                    }
                });
            }
        });
    });
</script>
@endsection



