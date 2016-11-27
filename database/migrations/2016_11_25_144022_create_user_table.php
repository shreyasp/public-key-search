<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned()->nullable();
            $table->timestamps();

            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('firstName', 255);
            $table->string('lastName', 255);
            $table->string('sessionId', 255);

            $table->unique('email');
            $table->unique('sessionId');
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
