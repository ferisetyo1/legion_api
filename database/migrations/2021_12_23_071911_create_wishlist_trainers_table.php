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
        Schema::create('legion_wishlist_trainers', function (Blueprint $table) {
            $table->id('wt_id');
            $table->integer('wt_pt_id');
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
        Schema::dropIfExists('legion_wishlist_trainers');
    }
}
