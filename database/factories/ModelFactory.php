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

$factory->define(App\Models\Event\Events::class, function ($faker) {
    return [
        'name'              => $faker->name,
        'location'          => $faker->city,
        'start_date'        => $faker->date($format = 'Y-m-d', $max = 'now'),
        'end_date'          => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});
