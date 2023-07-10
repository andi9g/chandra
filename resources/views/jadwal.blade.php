@extends('layouts.master')

@section('warnajadwal', 'active')
@section('judul', 'Jadwal Keberangkatan')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">

                </div>
                <div class="col-md-4">
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" name="cari" placeholder="berdasarkan nama" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{$search}}">
                            <div class="input-group-append">
                              <button class="btn btn-success" type="submit">
                                <i class="fa fa-search"></i> Cari
                              </button>
                            </div>
                          </div>

                    </form>

                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-striped table-bordered table-hover">
                <thead>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>Paket Travel</th>
                    <th>Tanggal Berangkat</th>
                    <th>Durasi</th>
                    <th>Email</th>
                    <th>KET</th>
                </thead>

                <tbody>
                    @foreach ($user as $item)
                    <tr>
                        <td>{{$loop->iteration + $user->firstItem() -1 }}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->namapaket}}</td>
                        <td>{{\Carbon\Carbon::parse($item->tanggalmulai)->isoFormat('dddd, DD MMMM Y')}}</td>
                        <td>{{$item->hari}} Hari</td>
                        <td>{{$item->email}}</td>
                        <td>
                            @php
                                $tgl1 = new DateTime($item->tanggalmulai);
                                $tgl2 = new DateTime();
                                $d = $tgl2->diff($tgl1)->days + 1;
                                $ket = false;
                                if(strtotime($item->tanggalmulai) > strtotime(date('Y-m-d'))) {
                                    $ket = true;
                                    // dd('berhasil');
                                }

                            @endphp
                            @if ($ket==true)
                                @if ($d > 5)
                                    <font class="text-success">{{$d}} Hari</font>
                                @else
                                    <font class="text-warning">{{$d}} Hari</font>
                                @endif
                            @else
                            <div class="text-danger">Telat {{$d}} Hari</font>
                            @endif
                        </td>

                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{$user->links('vendor.pagination.bootstrap-4')}}

        </div>
    </div>
</div>



@endsection




