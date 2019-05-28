<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 100)->unique();
            $table->integer('user_id');
            $table->integer('type');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->collation = 'utf8_unicode_ci';
            $table->charset = 'utf8';
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
}
