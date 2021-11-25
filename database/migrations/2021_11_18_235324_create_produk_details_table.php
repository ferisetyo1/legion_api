<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_detail_produk', function (Blueprint $table) {
            $table->id('dp_id');
            $table->integer("dp_produk_id");
            $table->string("dp_nama");
            $table->integer("dp_discount");
            $table->bigInteger("dp_harga");
            $table->integer("dp_stok");
            $table->dateTime("dp_create_at")->useCurrent();
            $table->dateTime("dp_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_detail_produk');
    }
}
