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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'term_id' => \App\Term::all()->last()->id,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Course::class, function (Faker\Generator $faker) {
    return [
      'subject' => $faker->name,
      'course_number' => $faker->postcode,
      'course_title' => $faker->sentence
    ];
});

// $factory->define(App\Task::class, function (Faker\Generator $faker) {
//     return [
//       'due_date' => \Carbon\Carbon::tomorrow(),
//       'course_id' => \App\Course::all()->random(1)->first()->id,
//       'title' => $faker->sentence,
//       'type' => \App\User::all()->random(1)->first()->types()->random(1)->first()->type_name
//     ];
// });
