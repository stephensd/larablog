<?php

use Faker\Generator as Faker;

$factory->define(App\Blog::class, function (Faker $faker) {
    return [
        'slug' => $faker->sentence(10),
        'meta_title' => $faker->sentence(10),
        'meta_description' => $faker->sentence(10),
        'slug' => str_slug($faker->sentence(10), '-'),
        'title' => $faker->sentence(10),
        'body' => $faker->sentence(100),
    ];
});
