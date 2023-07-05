<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use Auth;

class CreateSnapTokenService extends Midtrans
{
    protected $pesanan;

    public function __construct($pesanan)
    {
        parent::__construct();

        $this->pesanan = $pesanan;
    }

    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                'order_id' => $this->pesanan->number,
                'gross_amount' => $this->pesanan->totalharga,
            ],
            'item_details' => [
                [
                    'id' => $this->pesanan->idpesanan,
                    'price' => $this->pesanan->totalharga,
                    'quantity' => 1,
                    'name' => $this->pesanan->namapaket,
                ],
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => '081234567890',
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
