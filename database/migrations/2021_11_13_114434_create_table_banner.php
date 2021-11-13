<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_banner', function (Blueprint $table) {
            $table->id();
            $table->string("banner_gambar");
            $table->string("banner_kategori");
            $table->string("banner_detail");
            $table->dateTime("banner_create_at")->useCurrent();
            $table->dateTime("banner_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_banner');
    }
}
