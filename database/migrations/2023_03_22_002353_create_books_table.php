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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50); //題名
            $table->string('body', 200); //内容
            $table->string('image', 100)->nullable(); //表紙
            $table->string('release_date', 50)->nullable(); //発売日
            $table->bigInteger('category_id')->constrained()->onDelete('CASCADE');; //カテゴリー
            $table->bigInteger('author_id')->constrained()->onDelete('CASCADE');; //著者名
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
        Schema::dropIfExists('books');
    }
};
