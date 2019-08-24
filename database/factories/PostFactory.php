<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post_day' => Carbon::today(),
        'plan' => $faker->text,
        'do' => $faker->text,
        'check' => $faker->text,
        'action' => $faker->text,
        'wakeup_time' => '07:00',
        'bed_time' => '23:30',
        'user_id' => factory(\App\User::class, 1)->create()->first()->id
    ];
});
