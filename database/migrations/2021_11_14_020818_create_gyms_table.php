<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_gym', function (Blueprint $table) {
            $table->id("gym_id");
            $table->string("gym_user_id");
            $table->string("gym_nama");
            $table->string("gym_alamat");
            $table->decimal("gym_longitude");
            $table->decimal("gym_lotitude");
            $table->string("gym_isActive");
            $table->string("gym_status");
            $table->dateTime("gym_create_at")->useCurrent();
            $table->dateTime("gym_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_gym');
    }
}
