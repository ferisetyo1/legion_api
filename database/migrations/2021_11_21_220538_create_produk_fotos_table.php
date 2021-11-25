<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_foto_produk', function (Blueprint $table) {
            $table->id('fp_id');
            $table->integer('fp_produk_id');
            $table->string('fp_image_url');
            $table->dateTime("fp_create_at")->useCurrent();
            $table->dateTime("fp_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_foto_produk');
    }
}
