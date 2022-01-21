<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_notifs', function (Blueprint $table) {
            $table->id('notif_id');
            $table->integer('notif_user_id');
            $table->integer('notif_type_id');
            $table->string('notif_body');
            $table->string('notif_title');
            $table->text('notif_click_action')->nullable();
            $table->string('notif_is_read')->default(false);
            $table->dateTime("notif_create_at")->useCurrent();
            $table->dateTime("notif_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_notifs');
    }
}
