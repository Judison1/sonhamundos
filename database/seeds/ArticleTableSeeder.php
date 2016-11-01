<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_article')->delete();
        DB::table('article_tag')->delete();
        DB::table('articles')->delete();

        factory(\App\Article::class, 100)->create();
//        factory(\App\ArticleTag::class, 1000)->create();
//        factory(\App\CategoryArticle::class, 200)->create();

    }
}
