@extends('layouts.master')


@section('content')
    <div class="container">
        <h1>Invoice Details</h1>
    <p>Invoice Number: {{ $invoice->invoice_number }}</p>
    <p>Total Amount: {{ $invoice->total_payment }}</p>
    <p>Payer Name: {{ $invoice->name }}</p>
    <p>Payer Email: {{ $invoice->email }}</p>
    <p>Payer Phone: {{ $invoice->phone }}</p>
    {{-- <form action="{{ route('payment.callback') }}" method="POST">
        @csrf --}}
       
        <button id="pay-button">Pay with Midtrans</button>
    {{-- </form> --}}
    
    </div>
@endsection

@section('script')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                
            },
            onPending: function(result){
                // Proses jika pembayaran tertunda
            },
            onError: function(result){
                // Proses jika pembayaran gagal
            },
            onClose: function(){
                // Proses jika pembayaran ditutup
            }
        });
    };
</script>

@endsection