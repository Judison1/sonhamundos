<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function($table) {
            $table->increments('id');
            $table->integer('user_id')
                ->unsigned();
            $table->boolean('headline')
                ->default(false);

            $table->string('title');
            $table->string('synthesis');
            $table->longText('content');
            $table->string('path');
            $table->string('filename');
            $table->integer('views')
                ->default(0);
            $table->boolean('status')
                ->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
