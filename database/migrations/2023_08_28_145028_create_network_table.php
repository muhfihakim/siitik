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
        Schema::create('network', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi');
            $table->string('jenis');
            $table->string('titik');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('sn_aset');
            $table->date('tgl_pasang');
            $table->string('ba')->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('network');
    }
};
