<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_cart_temps', function (Blueprint $table) {
            $table->id('ct_id');
            $table->integer('ct_tp_id');
            $table->integer('ct_user_id');
            $table->integer('ct_produk_id');
            $table->integer('ct_dp_id');
            $table->integer('ct_jumlah');
            $table->integer('ct_harga_varian');
            $table->integer('ct_harga_varian_after_diskon');
            $table->integer('ct_varian_diskon');
            $table->integer('ct_produk_berat');
            $table->dateTime("ct_create_at")->useCurrent();
            $table->dateTime("ct_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_cart_temps');
    }
}
