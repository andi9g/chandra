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
        Schema::create('buktipembayaran', function (Blueprint $table) {
            $table->bigIncrements('idbuktipembayaran');
            $table->Integer('uid')->unique();
            $table->string('subject');
            $table->datetime('from');
            $table->string('message');
            $table->string('date');
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

        Schema::create('pemesanan', function (Blueprint $table) {
            $table->bigIncrements('idpemesanan');
            $table->string('number', 16);
            $table->Integer('iduser');
            $table->Integer('idpakettravel');
            $table->date('tanggalmulai');
            $table->date('tanggalselesai');
            $table->string('snap_token', 36)->nullable();
            $table->enum('ket', ['1','2','3']); // 1 = pendding; 2=gagal 3= terbayar
            $table->timestamps();
        });

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
