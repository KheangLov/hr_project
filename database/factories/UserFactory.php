<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'name_khmer' => $faker->name,
        'gender' => 'male',
        'dob' => '1990-02-10',
        'status' => 1,
        'annual_leave' => 18,
        'bank_account' => '21312388321',
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('not4you'),
        'salary' => 1233,
        'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'address' => 'asdsadasda',
        'department_id' => 1,
        'position_id' => 1,
        'unit_id' => 1,
        'group_id' => 1,
        'role_id' => 2
    ];
});
