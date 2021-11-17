<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_review_fotos', function (Blueprint $table) {
            $table->id('rf_id');
            $table->integer('rf_rr_id');
            $table->string('rf_image_url');
            $table->dateTime("rf_create_at")->useCurrent();
            $table->dateTime("rf_update_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_review_fotos');
    }
}
