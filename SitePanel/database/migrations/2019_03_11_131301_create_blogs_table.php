<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('title');
            $table->longText('body');
            $table->String('author');
            $table->enum('status',['active','deactive']);
            $table->String('image_url');
            $table->bigInteger('form_user_id')->unsigned();
            $table->foreign('form_user_id')->references('id')->on('users');
            $table->bigInteger('image_user_id')->unsigned();
            $table->foreign('image_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('blogs');
    }
}