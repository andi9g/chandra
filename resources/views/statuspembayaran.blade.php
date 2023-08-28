@extends('layouts.master')

@section('warnapembayaran', 'active')
@section('content')

<div class="container">
    <div class="" id="pesan"></div>
    @livewire('live-table')
</div>
@endsection


@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('script')

    <script>
        const delay = ms => new Promise(res => setTimeout(res, ms));
         $("#pembayaran").click(function(e){
            e.preventDefault();
            $("#pesan").addClass("");
            $("#pesan").addClass("alert alert-secondary");
            $("#pesan").html("DATA SEDANG MELAKUKAN SINKRON");
            getRealData();
         });


        function getRealData() {
            $.ajax({
                    url: "{{route('proses.pembayaran')}}",
                    type: "GET",
                    data:{},
                    cache: false,
                    success: function () {
                        $("#pesan").addClass("alert alert-success");
                        $("#pesan").html("DATA BERHASIL SINKRON");
                        setTimeout(function() {
                                $("#pesan").html("Wait to refresh");
                                location.reload();
                        }, 1500);

                    }
            });
        }
    </script>

@endsection
