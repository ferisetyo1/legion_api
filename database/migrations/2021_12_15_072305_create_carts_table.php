<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_carts', function (Blueprint $table) {
            $table->id('cart_id');
            $table->integer('cart_user_id');
            $table->integer('cart_produk_id');
            $table->integer('cart_dp_id');
            $table->integer('cart_jumlah');
            $table->dateTime("cart_create_at")->useCurrent();
            $table->dateTime("cart_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_carts');
    }
}
