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
//            $table->increments('id');
            $table->integer('category_id')
                ->unsigned();
            $table->integer('article_id')
                ->unsigned();
            $table->timestamps();

            $table->primary(['category_id', 'article_id']);

            $table->foreign('category_id')
                ->references('id')
                ->on('category');
            $table->foreign('article_id')
                ->references('id')
                ->on('articles');
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
