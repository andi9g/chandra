<div>



    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <button id="pembayaran" class="btn btn-secondary" onclick="return confirm('ingin melakukan sinkron?')">Sinkronkan Data</button>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input wire:model="cari" type="text" class="form-control" placeholder="berdasarkan nama" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-success" type="button">
                            <i class="fa fa-search"></i> Cari
                          </button>
                        </div>
                      </div>
                </div>
            </div>
        </div>



        <div class="card-body">
            <table class="table table-hover table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Paket Travel</th>
                        <th>Invoice</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <td width="5px">{{$loop->iteration}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->namapaket}}</td>
                            <td>{{$item->number}}</td>
                            <td>
                                @if ($item->ket == 3)
                                <font class="text-success">LUNAS</font>
                                @elseif($item->ket == 2)
                                <font class="text-warning">Sedang Di Proses</font>
                                @elseif($item->ket == 1)
                                <font class="text-danger">Belum melakukan Pembayaran</font>
                                @endif

                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $user->links('vendor.livewire.bootstrap') }}
        </div>
    </div>
</div>
