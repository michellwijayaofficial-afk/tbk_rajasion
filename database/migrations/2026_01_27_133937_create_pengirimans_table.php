<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pesanan_id');
            $table->string('nama_penerima');
            $table->string('notelp_penerima');
            $table->string('email');
            $table->string('alamat_penerima');
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->unsignedBigInteger('kab_id')->default(0);
            $table->unsignedBigInteger('kec_id')->default(0);
            $table->date('tgl_pengiriman');
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('pengirimans');
    }
}
