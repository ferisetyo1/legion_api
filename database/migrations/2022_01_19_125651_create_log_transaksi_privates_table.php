<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogTransaksiPrivatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_log_transaksi_privates', function (Blueprint $table) {
            $table->id('log_id');
            $table->integer('log_transaksi_id');
            $table->integer('log_code');
            $table->string('log_title');
            $table->text('log_body');
            $table->boolean('log_red_flags')->default(false);
            $table->dateTime("log_create_at")->useCurrent();
            $table->dateTime("log_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_transaksi_privates');
    }
}
