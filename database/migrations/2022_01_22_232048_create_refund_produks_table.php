<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_refund_produks', function (Blueprint $table) {
            $table->id('refund_id');
            $table->string('refund_invoice');
            $table->string('refund_nama_bank');
            $table->string('refund_no_rek');
            $table->string('refund_nama_rek');
            $table->string('refund_nohp');
            $table->dateTime("refund_create_at")->useCurrent();
            $table->dateTime("refund_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_refund_transaksis');
    }
}
