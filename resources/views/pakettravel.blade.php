@extends('layouts.master')

@section('warnapakettravel', 'active')
@section('judul', 'Paket Travel')

@section('content')
<div class="container">

    <div class="row">
        @foreach ($pakettravel as $item)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="my-0 py-0">{{$item->namapaket}}</h4>
                    <hr class="my-2 py-0">
                    <h6 class="my-0 py-0 text-bold">Total Harga :</h6>
                    <h5 class="my-0 mb-2 py-0">Rp{{number_format($item->totalharga, 0, ',', '.')}}</h5>
                    <h6 class="my-0 py-0 text-bold">Lama :</h6>
                    <h5 class="my-0 py-0">{{$item->hari}} Hari</h5>
                </div>

                <div class="card-footer my-0 py-2 text-right">
                    @php
                        $pemesanan = DB::table('pemesanan')->where('idpakettravel', $item->idpakettravel)->count();
                    @endphp
                    @if ($pemesanan > 0)
                        <a href="{{ url('pakettravel/pesanan/'.$item->idpakettravel, []) }}" class="btn btn-secondary">Lihat Paket Pesanan</a>
                    @else

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#pesanpaket{{$item->idpakettravel}}">
                      <i class="fa fa-calendar"></i> Pesan Paket
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="pesanpaket{{$item->idpakettravel}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Pesan {{$item->namapaket}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('pemesanan.paket', [$item->idpakettravel]) }}" method="post">
                                    @csrf
                                    <div class="modal-body text-left">
                                        <div class='form-group'>
                                            <label for='fortanggalmulai' class='text-capitalize '>Tanggal Mulai</label>
                                            <input type='date' min="{{date('Y-m-d', strtotime('+1 days', strtotime(now())))}}" name='tanggalmulai' id='fortanggalmulai' class='form-control' placeholder='masukan tanggal keberangkatan'>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>


@endsection
