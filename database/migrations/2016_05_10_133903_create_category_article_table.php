<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_article', function($table) {
            $table->increments('id');
            $table->integer('category_id')
                ->unsigned();
            $table->integer('article_id')
                ->unsigned();

            $table->foreign('category_id')
                ->references('id')
                ->on('category');
            $table->foreign('article_id')
                ->references('id')
                ->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_article');
    }
}
