<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('social_logins', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('userid')->unsigned();
            $table->string('userName', 255);
            $table->string('authToken', 255)->nullable();
            $table->string('websiteName', 255);
        });

        Schema::table('social_logins', function (Blueprint $table){
           $table->foreign('userid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_logins');
    }
}
