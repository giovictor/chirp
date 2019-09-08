<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'post' => $faker->text,
        'user_id' => $faker->randomElement(App\User::pluck('id')->toArray())
    ];
});
