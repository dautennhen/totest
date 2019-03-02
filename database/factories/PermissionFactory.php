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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Permission::class, function (Faker\Generator $faker) {

    return [
        'alias' => $faker->unique()->slug,
        'name' => $faker->unique()->jobTitle,
        'description' => $faker->sentence,
    ];
});