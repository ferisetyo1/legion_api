<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_wishlist_produks', function (Blueprint $table) {
            $table->id('wp_id');
            $table->integer('wp_produk_id');
            $table->integer('wp_user_id');
            $table->dateTime("wp_create_at")->useCurrent();
            $table->dateTime("wp_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_wishlist_produks');
    }
}
