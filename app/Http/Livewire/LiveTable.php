<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\pemesananM;
use App\Models\buktipembayaranM;
use Livewire\WithPagination;

class LiveTable extends Component
{
    use WithPagination;
    protected $updatesQueryString = [
        ['page' => ['except' => 1]],
        ['cari' => ['except' => '']],
    ];
    public $jml;
    public $cari;
    public $data;
    public $pagianteNumber = 10;

    public function render()
    {

        $search = empty($this->cari)?'':$this->cari;

        $user = pemesananM::leftJoin('buktipembayaran', 'buktipembayaran.number', 'pemesanan.number')
        ->join('users', 'users.id','pemesanan.iduser')
        ->join('pakettravel', 'pakettravel.idpakettravel','pemesanan.idpakettravel')
        ->latest()
        ->orderBy('buktipembayaran.uid', 'desc')
        ->where('users.name', 'like', "%$search%")
        ->select('pemesanan.*', 'users.name', 'users.email','pakettravel.namapaket')
        ->paginate($this->pagianteNumber);

        $this->jml = $user->total();

        // $this->data = $user;

        return view('livewire.live-table',[
            'user' => $user,
        ]);
    }


    public function statuspembayaran()
    {

    }
}
