@extends('layouts.master')

@section('warnainvoice', 'active')
@section('judul', $invoice_number)


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
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            
            <div class="card card-outline {{ $atas }} bg-opacity-75">
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

                        </table>
                    
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



