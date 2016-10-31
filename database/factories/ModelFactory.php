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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'permission_id' =>  \App\Permission::all()->random()->id,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'user_id'   =>  \App\User::all()->random()->id,
        'name'  =>  $faker->word,
        'description'   =>  $faker->text(254),
        'filename'  =>  'default.jpg',
        'created_at'    =>  $faker->dateTimeThisYear()
    ];
});
