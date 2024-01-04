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
        Schema::create('vm', function (Blueprint $table) {
            $table->id();
            $table->string('cluster');
            $table->string('vm');
            $table->string('os');
            $table->string('srv_node');
            $table->string('ip_public');
            $table->string('ip_private');
            $table->string('username');
            $table->string('password');
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('vm');
    }
};
