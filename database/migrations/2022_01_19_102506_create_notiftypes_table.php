<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotiftypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_notiftypes', function (Blueprint $table) {
            $table->id('notiftypes_id');
            $table->string('notiftypes_code')->unique();
            $table->string('notiftypes_title');
            $table->string('notiftypes_body');
            $table->string('notiftypes_params')->nullable();
            $table->text('notiftypes_icon');
            $table->boolean('notiftypes_forapps')->default(false);
            $table->dateTime("notiftypes_create_at")->useCurrent();
            $table->dateTime("notiftypes_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_notiftypes');
    }
}
