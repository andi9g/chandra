<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::get('pdf', 'startController@pdf');

// Route::get('siswa/export/', 'startController@export');

Auth::routes();
Route::get('login/google', 'Auth\LoginController@loginGoogle')->name('login.google');
Route::get('login/google/callback', 'Auth\LoginController@callbackGoogle');
Route::post('payments/midtrans-notification', 'callbackC@receive')->name('lihat.pembayaran');

Route::get('ordernow', "ordernowC@index")->name("ordernow");
Route::post('ordernow', "ordernowC@store")->name("ordernow.store");

Route::get('invoice', 'invoiceC@invoice');
Route::post('invoice', 'invoiceC@invoicepost')->name("show.invoice");
Route::get('invoice/{invoice_number}/show', 'invoiceC@showinvoice');
Route::post('invoice/{idinvoice}', 'invoiceC@tambahpassport')->name("tambah.passport");
Route::delete('invoice/{idpassport}', 'invoiceC@hapuspassport')->name("hapus.passport");

Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get("/home", "homeC@index");

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/pakettravel', 'pakettravelC@index');
    Route::post('/pakettravel/pemesanan/{idpakettravel}', 'pakettravelC@pemesanan')->name('pemesanan.paket');
    Route::get('/pakettravel/pesanan/{idpakettravel}', 'pakettravelC@pesanan');
    Route::get('/pesanan/show/{idpemesanan}', 'pakettravelC@show');
    // Route::post('/pesanan/ajaxPost/{idpemesanan}', 'pakettravelC@proses')->name('ajax.post');
    

    

    Route::get('order/{idinvoice}/show', 'invoiceC@ordernow')->name("order.now");
    Route::post('order/{idinvoice}/proses', 'invoiceC@proses')->name('ajax.post');
    // Route::get('/invoice/create', "pembayaranC@coba")->name('invoice.create');

    Route::middleware(['GerbangAdmin'])->group(function () {
        Route::get('pembayaran', 'pembayaranC@index');
        Route::get('pembayaran/proses', 'pembayaranC@proses')->name('proses.pembayaran');

        Route::get("order", "orderC@index");
        Route::get("order/show/edit/{idinvoice}", "orderC@show")->name("order.show");
        Route::get("order/tambah", "orderC@order")->name("tambah.order");
        Route::delete("order/hapus/{idinvoice}", "orderC@hapus")->name("hapus.order");
        Route::post("order/konfirmation/{idinvoice}", "orderC@konfirmasi")->name("konfirmation.invoice");
        Route::post("order/tambah", "orderC@createorder")->name("order.create.order");
        Route::put("order/edit/{idinvoice}", "orderC@editorder")->name("order.edit.order");
        Route::get("print", "orderC@cetak")->name("cetak.order");
        
        Route::get("calendar", "orderC@calendar");
        
        Route::get('jadwal', 'jadwalC@index');

    });



});
