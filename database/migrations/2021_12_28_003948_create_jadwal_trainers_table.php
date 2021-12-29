<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legion_jadwal_trainers', function (Blueprint $table) {
            $table->id('jt_id');
            $table->integer('jt_pt_id');
            $table->integer('jt_gym_id');
            $table->boolean('jt_pt_confirm')->default(false);
            $table->boolean('jt_gym_confirm')->default(false);
            $table->string('jt_hari');
            $table->string('jt_kategories');
            $table->dateTime("jt_create_at")->useCurrent();
            $table->dateTime("jt_update_at")->useCurrent()->useCurrentOnUpdate();
        });
        //jt_kategories input
        // $array=[
        //     [
        //         "kht_id"=>1,
        //         "pt_confirm"=>true,
        //     ],
        //     [
        //         "kht_id"=>2,
        //         "pt_confirm"=>true,
        //     ],
        //     [
        //         "kht_id"=>3,
        //         "pt_confirm"=>true,
        //     ],
        // ];
        // $input=json_encode($array);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legion_jadwal_trainers');
    }
}
