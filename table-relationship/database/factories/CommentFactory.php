<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        "text" => $faker->sentence,
        "user_id" => \App\User::all()->random()->id,
        "article_id" => \App\Article::all()->random()->id
    ];
});
