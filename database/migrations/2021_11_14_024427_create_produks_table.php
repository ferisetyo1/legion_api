<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_produk', function (Blueprint $table) {
            $table->id("produk_id");
            $table->string("produk_nama");
            $table->string("produk_kategori");
            $table->string("produk_merk");
            $table->string("produk_berat");
            $table->string("produk_origin");
            $table->text("produk_detail");
            $table->string("produk_gambar");
            $table->integer("produk_discount");
            $table->bigInteger("produk_harga");
            $table->integer("produk_stok");
            $table->dateTime("produk_create_at")->useCurrent();
            $table->dateTime("produk_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_produk');
    }
}
