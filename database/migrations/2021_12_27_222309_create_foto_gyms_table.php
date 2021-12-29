<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoGymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_foto_gyms', function (Blueprint $table) {
            $table->id('fg_id');
            $table->integer('fg_gym_id');
            $table->string('fg_image_url');
            $table->dateTime("fg_create_at")->useCurrent();
            $table->dateTime("fg_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_foto_gyms');
    }
}
