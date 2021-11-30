<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargaTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_harga_trainer', function (Blueprint $table) {
            $table->id("ht_id");
            $table->integer('ht_pt_id');
            $table->integer('ht_harga');
            $table->integer('ht_waktu');
            $table->integer('ht_kategory');
            $table->dateTime("ht_create_at")->useCurrent();
            $table->dateTime("ht_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('harga_trainers');
    }
}
