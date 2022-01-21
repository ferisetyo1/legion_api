<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokencloudmsgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_tokencloudmsgs', function (Blueprint $table) {
            $table->id('token_id');
            $table->integer('token_user_id');
            $table->string('token_value');
            $table->dateTime("token_create_at")->useCurrent();
            $table->dateTime("token_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_tokencloudmsgs');
    }
}
