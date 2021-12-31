<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPrivatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_transaksi_privat', function (Blueprint $table) {
            $table->id('tp_id');
            $table->integer('tp_user_id');
            $table->integer('tp_pt_id');
            $table->integer('tp_ht_id');
            $table->integer('tp_ap_id')->nullable();
            $table->string('tp_invoice');
            $table->string('tp_tgl_private');
            $table->string('tp_jam_private');
            $table->string('tp_nama_gym')->nullable();
            $table->string('tp_token_payment');
            $table->string('tp_metode_pembayaran');
            $table->string('tp_waktu_expired');
            $table->boolean('tp_is_paid')->default(false);
            $table->boolean('tp_is_confirm')->default(false);
            $table->boolean('tp_is_mulai')->default(false);
            $table->boolean('tp_is_cancel')->default(false);
            $table->boolean('tp_is_done')->default(false);
            $table->text('tp_generate_url')->nullable();
            $table->text('tp_meet_url')->nullable();
            $table->string("tp_nama_payment_lib")->default("CashlezApi");
            $table->string("tp_nama_ongkir_lib")->default("RajaOngkir");
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
        Schema::dropIfExists('legion_transaksi_privat');
    }
}
