<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlamatPrivatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_alamat_privates', function (Blueprint $table) {
            $table->id('ap_id');
            $table->integer('ap_user_id');
            $table->string('ap_nama');
            $table->string('ap_type');
            $table->text('ap_alamat');
            $table->text('ap_detail');
            $table->text('ap_nama_penerima');
            $table->string('ap_no_telpon');
            $table->string('ap_lat');
            $table->string('ap_lon');
            $table->dateTime("ap_create_at")->useCurrent();
            $table->dateTime("ap_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_alamat_privates');
    }
}
