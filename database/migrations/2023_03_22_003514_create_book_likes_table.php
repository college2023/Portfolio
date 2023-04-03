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
        Schema::create('book_likes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('book_review_id')->unsigned(); //本くちこみid
            $table->bigInteger('user_id')->unsigned(); //投稿者
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
        Schema::dropIfExists('book_likes');
    }
};
