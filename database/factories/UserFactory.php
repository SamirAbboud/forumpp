<?php

use Faker\Generator as Faker;
use Forum\Channel;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Forum\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
$factory->define(Forum\Thread::class, function (Faker $faker) {
    return [

        'user_id' => function () {
            return factory(Forum\User::class)->create()->id;
        },

        'channel_id' => function () {
            return factory(Channel::class)->create()->id;
        },

        'title' => $faker->sentence,
        'body' => $faker->paragraph,

    ];
});

$factory->define(Forum\Reply::class, function (Faker $faker) {
    return [

        'user_id' => function () {
            return factory(Forum\User::class)->create()->id;
        },
        'thread_id' => function () {
            return factory(Forum\Thread::class) ->create()->id;
         },
        'body' => $faker->paragraph,

    ];
});

$factory->define(Channel::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->word,
    ];
});