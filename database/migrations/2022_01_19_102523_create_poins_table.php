<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_poins', function (Blueprint $table) {
            $table->id('poins_id');
            $table->integer('poins_user_id');
            $table->integer('poins_from');
            $table->integer('poins_value');
            $table->dateTime('poins_expired');
            $table->dateTime("poins_create_at")->useCurrent();
            $table->dateTime("poins_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_poins');
    }
}
