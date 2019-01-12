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
            $table->longText('details');
            $table->string('primary_url',191)->unique(); // http://www.kohls.com
            $table->string('secondary_url',191)->unique(); // kohls.com
            $table->string('network_id');
            $table->foreign('network_id')->references('id')->on('networks')->onDelete('cascade');
            $table->string('network_url');
            $table->enum('type',['popular','regular']);
            $table->enum('status',['active','deactive']);
            $table->string('logo_url');
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
