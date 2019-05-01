<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id')->primarykey();
            $table->string('title',191)->unique();
            $table->longText('description');
            $table->string('primary_url'); // http://www.kohls.com
            $table->string('secondary_url',191)->unique(); // kohls.com
            $table->bigInteger('network_id')->unsigned();
            $table->foreign('network_id')->references('id')->on('networks');
            $table->string('network_url');
            $table->enum('is_topstore',['yes','no']);
            $table->enum('is_popularstore',['yes','no']);
            $table->enum('status',['active','deactive']);
            $table->string('logo_url');
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
        Schema::dropIfExists('stores');
    }
}
