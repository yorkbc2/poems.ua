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
            $table->increments('id');
            $table->string("ulogin")->nullable()->unique();
            $table->string("email")->nullable()->unique();
            $table->string("name")->nullable();
            $table->string("api_key")->nullable();
            $table->string("password")->nullable();
            $table->integer("email_able")->nullable();
            $table->string("image")->nullable();
            $table->integer("born_day")->nullable();
            $table->integer("born_month")->nullable();
            $table->integer("born_year")->nullable();
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
        Schema::dropIfExists('users');
    }
}
