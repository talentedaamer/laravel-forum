<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Answer::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::pluck('id')->random(),
        'votes' => rand(0, 10),
        'body' => $faker->paragraph( rand(2,5), true)
    ];
});
