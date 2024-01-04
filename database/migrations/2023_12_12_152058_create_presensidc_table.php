<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensidc', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('instansi');
            $table->string('kotakab');
            $table->string('jenis_identitas');
            $table->string('no_identitas');
            $table->string('no_badge')->nullable();
            $table->date('tanggal');
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->string('tujuan');
            $table->string('keluar_perangkat')->nullable();
            $table->string('masuk_perangkat')->nullable();
            $table->string('selfie');
            $table->string('ttd');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('presensidc');
    }
};
