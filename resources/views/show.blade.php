@extends('layouts.master')

@section('warnapakettravel', 'active')
@section('judul', $judul)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Detail Pemesanan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <tr>
                            <td>Nomor Invoice </td>
                            <td>:</td>
                            <td>{{$pesanan->number}}</td>
                        </tr>

                        <tr>
                            <td>Name Pemesan</td>
                            <td>:</td>
                            <td>{{Auth::user()->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{Auth::user()->email}}</td>
                        </tr>

                        <tr>
                            <td>Durasi</td>
                            <td>:</td>
                            <td>{{$pesanan->hari}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Keberangkatan</td>
                            <td>:</td>
                            <td>{{\Carbon\Carbon::parse($pesanan->tanggalmulai)->isoFormat('dddd, DD MMMM Y')}}</td>
                        </tr>

                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>:</td>
                            <td>{{\Carbon\Carbon::parse($pesanan->tanggalselesai)->isoFormat('dddd, DD MMMM Y')}}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <h3>
                <table class="table-striped table">
                    <tr>
                        <td>Total</td>
                        <td>:</td>
                        <td>Rp{{number_format($pesanan->totalharga,0,',','.')}}</td>
                    </tr>
                </table>

            </h3>

            @if ($pesanan->ket == 1)
                <button class="btn btn-primary btn-block" id="pay-button">Lakukan Pembayaran</button>
            @else
                Payment successful
            @endif
        </div>
    </div>

</div>




@endsection


@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();

        snap.pay('{{ $snapToken }}', {
            // Optional
            onSuccess: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log(result)
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
                console.log(result)
            }
        });
    });
</script>
@endsection



