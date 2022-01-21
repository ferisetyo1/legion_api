<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_customer', function (Blueprint $table) {
            $table->id('customer_id');
            $table->integer('customer_user_id');
            $table->string('customer_nama');
            $table->integer('customer_tinggi')->nullable();
            $table->integer('customer_berat')->nullable();
            $table->dateTime('customer_tanggal_lahir')->nullable();
            $table->string('customer_gender')->nullable();
            $table->string('customer_image')->nullable();
            $table->string('customer_is_delete')->default(false);
            $table->dateTime("customer_create_at")->useCurrent();
            $table->dateTime("customer_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_customer');
    }
}
