<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_rating_reviews', function (Blueprint $table) {
            $table->id('rr_id');
            $table->integer('rr_user_id');
            $table->integer('rr_gym_id')->default(-1);
            $table->integer('rr_produk_id')->default(-1);
            $table->integer('rr_pt_id')->default(-1);
            $table->integer('rr_star');
            $table->text('rr_desc');
            $table->dateTime("rr_create_at")->useCurrent();
            $table->dateTime("rr_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_rating_reviews');
    }
}
