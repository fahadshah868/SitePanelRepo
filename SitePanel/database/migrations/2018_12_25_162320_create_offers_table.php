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
            $table->longText('title');
            $table->bigInteger('offer_type_id')->unsigned();
            $table->foreign('offer_type_id')->references('id')->on('offer_types')->onDelete('cascade');
            $table->string('code')->nullable();
            $table->longText('details');
            $table->bigInteger('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->date('starting_date');
            $table->date('expiry_date')->nullable();
            $table->bigInteger('uses')->nullable();
            $table->enum('type',['regular','popular']);
            $table->enum('status',['active','deactive']);
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
