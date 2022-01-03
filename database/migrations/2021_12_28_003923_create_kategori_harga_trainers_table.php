<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriHargaTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_kategori_harga_trainers', function (Blueprint $table) {
            $table->id('kht_id');
            $table->string('kht_nama');
            $table->string('kht_is_online');
            $table->dateTime("kht_create_at")->useCurrent();
            $table->dateTime("kht_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_kategori_harga_trainers');
    }
}
