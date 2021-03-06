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
            $table->integer("produk_pt_id");
            $table->integer("produk_pk_id");
            $table->string("produk_nama");
            $table->string("produk_merk");
            $table->string("produk_berat");
            $table->string("produk_origin");
            $table->text("produk_detail");
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
