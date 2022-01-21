<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_pt', function (Blueprint $table) {
            $table->id("pt_id");
            $table->integer("pt_gym_id");
            $table->integer("pt_user_id");
            $table->string("pt_nama");
            $table->date("pt_tanggal_lahir")->nullable();
            $table->string("pt_gender")->nullable();
            $table->integer("pt_tinggi")->nullable();
            $table->integer("pt_berat")->nullable();
            $table->text("pt_image")->nullable();
            $table->text("pt_desc")->nullable();
            $table->string("pt_kota")->nullable();
            $table->text("pt_alamat")->nullable();
            $table->text("pt_is_delete")->default(false);
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
        Schema::dropIfExists('legion_pt');
    }
}
