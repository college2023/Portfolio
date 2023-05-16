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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('address', 100); //住所
            $table->string('body', 400); //くちこみ内容
            $table->string('image_url')->nullable(); //追加//Cloudinaryの画像保存
            $table->string('book_id'); //api
            $table->foreignId("user_id")->constrained(); //ユーザ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
