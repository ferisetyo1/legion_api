<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_produk_tipes', function (Blueprint $table) {
            $table->id('pt_id');
            $table->string("pt_nama");
            $table->dateTime("pt_create_at")->useCurrent();
            $table->dateTime("pt_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_produk_tipes');
    }
}
