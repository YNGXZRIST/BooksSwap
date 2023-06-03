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
        Schema::create('users', function (Blueprint $table) {//users- название таблицы
            $table->id();// первичный ключ
            $table->string('name');// имя пользователя
            $table->string('email')->unique();// email. уникальный
            $table->timestamp('email_verified_at')->nullable();// когда была подтверждена почта, может быть null
            $table->string('password');// hash- пароль
            $table->rememberToken();// токен пользователя
            $table->timestamps();// время создания и обновления
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
