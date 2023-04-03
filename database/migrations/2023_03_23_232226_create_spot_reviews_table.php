<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spot_reviews', function (Blueprint $table) {
            $table->id();
            //$table->string('title', 50); //くちこみタイトル
            $table->string('body', 300); //くちこみ内容
            $table->string('review'); //★の数
            $table->bigInteger('user_id')->unsigned(); //投稿者
            $table->bigInteger('spot_id')->unsigned(); //場所
            $table->timestamps(); //created_atとupdated_at
            $table->softDeletes(); //deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spot_reviews');
    }
};
