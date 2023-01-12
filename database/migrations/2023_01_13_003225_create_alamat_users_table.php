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
        Schema::create('alamat_users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('id_user');
            $table->string('nama');
            $table->string('telepon');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kode_provinsi');
            $table->string('kode_kota');
            $table->string('kode_pos');
            $table->string('alamat');
            $table->boolean('utama')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('alamat_users');
    }
};
