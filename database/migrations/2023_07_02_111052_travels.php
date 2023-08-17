<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Travels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->bigIncrements('idinvoice');
            $table->string("invoice_number")->unique();
            $table->decimal('total_payment', 9, 2)->default(0);
            $table->enum("status", ["pending", "success", "fail"]);
            $table->string('transaction_id')->nullable();
            $table->date('datestart');
            $table->date('dateend');
            $table->string('accomodation');
            $table->string('email');
            $table->string('name');
            $table->string('phone');
            $table->string('note');
            $table->timestamps();
        });

        Schema::create('snaptoken', function (Blueprint $table) {
            $table->bigIncrements('idsnaptoken');
            $table->integer("idinvoice");
            $table->String("snaptoken")->unique();
            $table->timestamps();

        });
        

        Schema::create('buktipembayaran', function (Blueprint $table) {
            $table->bigIncrements('uid');
            $table->string('number', 16)->unique();
            $table->string('subject');
            $table->string('from');
            $table->longText('message');
            $table->dateTime('date');
            $table->timestamps();
        });

        Schema::create('pemesanan', function (Blueprint $table) {
            $table->bigIncrements('idpemesanan');
            $table->string('number', 16)->unique();
            $table->Integer('iduser');
            $table->Integer('idpakettravel');
            $table->date('tanggalmulai');
            $table->date('tanggalselesai');
            $table->string('snap_token', 36)->nullable();
            $table->enum('ket', ['1','2','3']); // 1 = pendding; 2=gagal 3= terbayar
            $table->timestamps();
        });

        Schema::create('identitas', function (Blueprint $table) {
            $table->bigIncrements('ididentitas');
            $table->integer('iduser')->unique();
            $table->String('nohp');
            $table->String('tanggallahir');
            $table->String('tempatlahir');
            $table->String('alamat');
            $table->timestamps();
        });

        Schema::create('pakettravel', function (Blueprint $table) {
            $table->bigIncrements('idpakettravel');
            $table->String('namapaket');
            $table->decimal('totalharga', 10,2);
            $table->integer('hari');
            $table->timestamps();
        });

        DB::table('pakettravel')->insert([
            'namapaket' => 'Paket Travel 1',
            'totalharga' => 2500000,
            'hari' => 4,
        ]);



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
