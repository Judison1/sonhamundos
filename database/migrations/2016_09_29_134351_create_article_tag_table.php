<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tag', function ($table){
            $table->increments('id');
            $table->integer('article_id')
                ->unsigned();
            $table->integer('tag_id')
                ->unsigned();


            $table->foreign('article_id')
                ->references('id')
                ->on('articles');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tag');
    }
}
