<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_produk_kategoris', function (Blueprint $table) {
            $table->id('pk_id');
            $table->string('pk_nama');
            $table->string('pk_image');
            $table->dateTime("pk_create_at")->useCurrent();
            $table->dateTime("pk_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_produk_kategoris');
    }
}
