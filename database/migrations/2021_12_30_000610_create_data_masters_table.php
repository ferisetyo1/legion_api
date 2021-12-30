<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_data_masters', function (Blueprint $table) {
            $table->id('dm_id');
            $table->string('dm_key');
            $table->text('dm_data');
            $table->dateTime("dm_create_at")->useCurrent();
            $table->dateTime("dm_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_data_masters');
    }
}
