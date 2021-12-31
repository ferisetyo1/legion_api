<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_transaksi_produks', function (Blueprint $table) {
            $table->id("tp_id");
            $table->integer('tp_user_id');
            $table->integer('tp_ap_id');//alamat pengiriman
            $table->string('tp_invoice');
            $table->string('tp_metode_pembayaran')->nullable();
            $table->string('tp_token_payment');
            $table->string('tp_checkout_url')->nullable();
            $table->string('tp_jasa_pengiriman')->nullable();
            $table->integer('tp_no_resi')->nullable();
            $table->dateTime('tp_tgl_expired_payment')->nullable();
            $table->boolean('tp_is_paid')->default(false);
            $table->boolean('tp_is_confirm')->default(false);
            $table->boolean('tp_is_dikemas')->default(false);
            $table->boolean('tp_is_done')->default(false);
            $table->boolean('tp_is_cancel')->default(false);
            $table->bigInteger("tp_ongkir");
            $table->string("tp_nama_payment_lib")->default("CashlezApi");
            $table->string("tp_nama_ongkir_lib")->default("RajaOngkir");
            $table->dateTime("tp_create_at")->useCurrent();
            $table->dateTime("tp_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_transaksi_produks');
    }
}
