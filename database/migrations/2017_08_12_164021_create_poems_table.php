<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poems', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->nullable();
            $table->text("content")->nullable();
            $table->integer("category_id")->nullable();
            $table->string("author_name")->nullable();
            $table->integer("author_id")->nullable();
            $table->string("image")->nullable();
            $table->integer("status")->nullable();
            $table->datetime("date")->nullable();
            $table->integer("views")->nullable();
            $table->integer("stars")->nullable();
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
        Schema::dropIfExists('poems');
    }
}
