<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlist_trainers', function (Blueprint $table) {
            $table->id('wt_id');
            $table->integer('wt_trainer_id');
            $table->integer('wt_user_id');
            $table->dateTime("wt_create_at")->useCurrent();
            $table->dateTime("wt_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlist_trainers');
    }
}
