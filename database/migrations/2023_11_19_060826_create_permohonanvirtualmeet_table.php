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
        Schema::create('permohonanvirtualmeet', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('instansi');
            $table->string('pemohon');
            $table->string('tlp');
            $table->string('judul');
            $table->dateTime('waktu_pelaksanaan');
            $table->string('lokasi');
            $table->string('partisipan');
            $table->string('surat_permohonan')->nullable();
            $table->string('surat_perintah')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('permohonanvirtualmeet');
    }
};
