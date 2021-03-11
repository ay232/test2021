<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function () {
    $faker = \Faker\Factory::create('ru_RU');
    return [
        'title'=>\Illuminate\Support\Str::limit($faker->name,10,""),
        'price'=>$faker->randomFloat(2,0,200),
    ];
});
