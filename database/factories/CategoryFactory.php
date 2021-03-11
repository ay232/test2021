<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function () {
    $faker = \Faker\Factory::create('ru_RU');
    return [
        'title'=>\Illuminate\Support\Str::limit($faker->word,10,""),
    ];
});
