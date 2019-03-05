<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarouselOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousel_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->longText('title');
            $table->enum('location',['Online','In-Store','Online & In-Store']);
            $table->enum('type',['Code','Sale']);
            $table->string('code')->nullable();
            $table->date('starting_date');
            $table->date('expiry_date')->nullable();
            $table->string('image_url');
            $table->enum('status',['active','deactive']);
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
        Schema::dropIfExists('carousel_offers');
    }
}
