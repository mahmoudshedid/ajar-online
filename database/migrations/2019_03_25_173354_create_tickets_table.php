<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->integer('unit_id');
            $table->integer('from_user_id');
            $table->integer('to_user_id');
            $table->integer('assigned_user_id')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('type');
            $table->decimal('amount', 8, 2);
            $table->text('description');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
