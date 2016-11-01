<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
use Illuminate\Support\Facades\DB;
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->name,
        'email' => $faker->safeEmail,
        'description'   =>  $faker->text(200),
        'permission_id' =>  \App\Permission::all()->random()->id,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'user_id'   =>  \App\User::all()->random()->id,
        'name'  =>  $faker->word . ' ' . str_random(2),
        'description'   =>  $faker->text(254),
        'filename'  =>  'default.jpg',
        'created_at'    =>  $faker->dateTimeThisYear()
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name'  =>  $faker->word . ' ' . str_random(5)
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        'user_id'   =>  \App\User::all()->random()->id,
        'title'  =>  $faker->sentence() ,
        'synthesis' =>  $faker->text(200),
        'filename'  =>  'default.jpg',
        'path'  =>  'articles',
        'content'   =>  $faker->text(10000),
        'status'    => 1,
        'views'  =>  $faker->numberBetween(100,10000),
        'headline'  => $faker->numberBetween(0,1),
        'created_at'    =>  $faker->dateTimeThisYear()
    ];
});

$factory->define(\App\ArticleTag::class, function (Faker\Generator $faker) {
    return [
        'article_id'  =>  \App\Article::all()->random()->id,
        'tag_id'  =>  \App\Tag::all()->random()->id
    ];
});

$factory->define(\App\CategoryArticle::class, function (Faker\Generator $faker) {
    return [
        'article_id'  =>  \App\Article::all()->random()->id,
        'category_id'  =>  \App\Tag::all()->random()->id
    ];
});