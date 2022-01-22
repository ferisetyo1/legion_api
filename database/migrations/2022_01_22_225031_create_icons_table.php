<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_icons', function (Blueprint $table) {
            $table->id('icon_id');
            $table->string('icon_name');
            $table->text('icon_url');
            $table->dateTime("icon_create_at")->useCurrent();
            $table->dateTime("icon_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_icons');
    }
}
