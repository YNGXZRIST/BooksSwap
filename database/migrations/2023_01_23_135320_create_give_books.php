<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiveBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('give_books', function (Blueprint $table) {
            $table->id();
            $table->string('author');
            $table->string('title');
            $table->string('address');
            $table->string('description');
            $table->string('coordinates')->nullable();
            $table->integer('city_id');
            $table->integer('user_id');
            $table->string('condition');
            $table->string('price')->nullable();
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
        Schema::dropIfExists('give_books');
    }
}
