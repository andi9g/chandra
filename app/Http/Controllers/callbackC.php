<?php

namespace App\Http\Controllers;

use App\Models\pemesananM;
use Illuminate\Http\Request;
use App\Services\Midtrans\CallbackService;
// use Midtrans\Notification;

class callbackC extends Controller
{
    public function receive()
    {

        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();
            // dd($order);

            if ($callback->isSuccess()) {
                pemesananM::where('idpemesanan', $order->idpemesanan)->update([
                    'ket' => 3,
                ]);
            }

            if ($callback->isExpire()) {
                pemesananM::where('idpemesanan', $order->idpemesanan)->update([
                    'ket' => 2,
                ]);
            }

            if ($callback->isCancelled()) {
                pemesananM::where('idpemesanan', $order->idpemesanan)->update([
                    'ket' => 1,
                ]);
            }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notifikasi berhasil diproses',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi',
                ], 403);
        }
    }
}
