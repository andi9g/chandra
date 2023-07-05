@extends('layouts.master')

@section('warnapakettravel', 'active')
@section('judul', $judul->namapaket)

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#pesanpaket{{$judul->idpakettravel}}">
                <i class="fa fa-calendar"></i> Tambah Paket Pemesanan
              </button>

              <div class="modal fade" id="pesanpaket{{$judul->idpakettravel}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pesan {{$judul->namapaket}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <form action="{{ route('pemesanan.paket', [$judul->idpakettravel]) }}" method="post">
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
        </div>

        <div class="card-body">
            <table class="table table-sm table-striped table-bordered table-hover">
                <thead>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Detail</th>
                    <th>Total Bayar</th>
                    <th>Ket</th>
                    <th>Aksi</th>
                </thead>

                <tbody>
                    @foreach ($pesanan as $item)
                    <tr>
                        <td width="2%">{{$loop->iteration}}</td>
                        <td>{{$item->namapaket}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="badge badge-primary border-0 py-1" data-toggle="modal" data-target="#detail{{$item->idpemesanan}}">
                              <i class="fa fa-eye"></i> Detail
                            </button>
                        </td>
                        <td>Rp{{number_format($item->totalharga, 0, ',', '.')}}</td>

                        <td>
                            @if ($item->ket == '1')
                                <font class="text-warning">Belum melakukan pembayaran</font>

                            @elseif($item->ket == '2')
                                <font class="text-danger">Pembayaran Gagal</font>
                            @elseif($item->ket == '3')
                                <font class="text-success">Pembayaran berhasil</font>
                            @endif
                        </td>

                        <td>
                            <a href="{{ url('pesanan/show/'.$item->idpemesanan) }}" class="badge badge-primary border-0 py-1" onclick="return confirm('Lanjutkan proses pembayaran?')">
                                Lakukan Pembayaran
                            </a>
                        </td>
                    </tr>


                    <div class="modal fade" id="detail{{$item->idpemesanan}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                            <h5 class="modal-title">Detail Pemesanan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class='form-group'>
                                            <label for='fortanggalmulai' class='text-capitalize'>Durasi</label>
                                            <input type='text' name='tanggalmulai' id='fortanggalmulai' class='form-control' readonly placeholder='masukan tanggal mulai' value="{{$item->hari}} Hari">
                                        </div>
                                        <div class='form-group'>
                                            <label for='fortanggalmulai' class='text-capitalize'>Tanggal Mulai</label>
                                            <input type='text' name='tanggalmulai' id='fortanggalmulai' class='form-control' readonly placeholder='masukan tanggal mulai' value="{{$item->tanggalmulai}}">
                                            <i><p>{{\Carbon\Carbon::parse($item->tanggalmulai)->isoFormat('dddd, DD MMMM Y')}}</p></i>
                                        </div>
                                        <div class='form-group'>
                                            <label for='fortanggalmulai' class='text-capitalize'>Tanggal Selesai</label>
                                            <input type='text' name='tanggalmulai' id='fortanggalmulai' class='form-control' readonly placeholder='masukan tanggal mulai' value="{{$item->tanggalselesai}}">
                                            <i><p>{{\Carbon\Carbon::parse($item->tanggalselesai)->isoFormat('dddd, DD MMMM Y')}}</p></i>
                                        </div>
                                        <div class='form-group'>
                                            <label for='forname' class='text-capitalize'>Nama Pemesan</label>
                                            <input type='text' name='name' id='forname' class='form-control' readonly placeholder='masukan tanggal mulai' value="{{Auth::user()->name}}">
                                        </div>

                                        <div class='form-group'>
                                            <label for='forname' class='text-capitalize'>Email</label>
                                            <input type='text' name='name' id='forname' class='form-control' readonly placeholder='masukan tanggal mulai' value="{{Auth::user()->email}}">
                                        </div>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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


@endsection
