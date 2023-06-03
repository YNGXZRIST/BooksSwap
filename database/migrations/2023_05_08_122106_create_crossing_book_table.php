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
        Schema::create('crossing_book', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crossing_id');
            $table->foreign('crossing_id')->references('id')->on('crossing');
            $table->string('location',255);
            $table->string('location_description',255)->nullable();
            $table->tinyInteger('status');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('cover_url',255)->nullable();
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
        Schema::dropIfExists('crossing_book');
    }
};
