<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->longText('title');
            $table->string('anchor');
            $table->enum('location',['Online','In-Store','Online & In-Store']);
            $table->enum('type',['Code','Sale']);
            $table->enum('free_shipping',['y','n']);
            $table->string('code')->nullable();
            $table->longText('details');
            $table->date('starting_date');
            $table->date('expiry_date')->nullable();
            $table->enum('is_popular',['y','n']);
            $table->enum('display_at_home',['y','n']);
            $table->enum('is_verified',['y','n']);
            $table->enum('is_active',['y','n']);
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('offers');
    }
}
