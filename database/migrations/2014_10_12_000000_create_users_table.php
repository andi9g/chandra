<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('provider_id')->nullable();
            $table->string('avatar')->nullable();
            $table->char('nohp', 16)->nullable();
            $table->enum('posisi', ['user', 'admin']);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'name' => 'Chandra',
            'email' => 'chandra.james3219421@gmail.com',
            'avatar' => 'https://lh3.googleusercontent.com/a/AAcHTtcjbMPl3N1EBi7UQeN0RdknNdLgSQUCFrDHMGPTH-ng=s96-c',
            'posisi' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        DB::table('users')->insert([
            'name' => 'ramadhan',
            'email' => 'ramadhan89.ari@gmail.com',
            'avatar' => 'https://lh3.googleusercontent.com/a/AAcHTtcjbMPl3N1EBi7UQeN0RdknNdLgSQUCFrDHMGPTH-ng=s96-c',
            'posisi' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'andirizky.bayuputra@gmail.com',
            'avatar' => 'https://lh3.googleusercontent.com/a/AAcHTtcjbMPl3N1EBi7UQeN0RdknNdLgSQUCFrDHMGPTH-ng=s96-c',
            'posisi' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'c6879092@gmail.com',
            'avatar' => 'https://lh3.googleusercontent.com/a/AAcHTtcjbMPl3N1EBi7UQeN0RdknNdLgSQUCFrDHMGPTH-ng=s96-c',
            'posisi' => 'admin',
            'password' => Hash::make('admin'),
        ]);


    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
