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
        for ($i=1; $i <= 10; $i++) { 

            for ($e=$i*10 - 9; $e <= $i*10; $e++) { 
                DB::table('category_article')->insert([
                    ['category_id' => $i, 'article_id' => $e]
                ]);
            }
        }
//        factory(\App\CategoryArticle::class, 200)->create();

    }
}
