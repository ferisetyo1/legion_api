<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_gym_fasilitas', function (Blueprint $table) {
            $table->id("gf_id");
            $table->integer("gf_gym_id");
            $table->string("gf_nama");
            $table->string("gf_image_url");
            $table->dateTime("gf_create_at")->useCurrent();
            $table->dateTime("gf_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_gym_fasilitas');
    }
}
