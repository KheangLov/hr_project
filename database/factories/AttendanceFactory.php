<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attendance;
use Faker\Generator as Faker;

$factory->define(Attendance::class, function (Faker $faker) {
    return [
        'request_date' => $faker->dateTimeBetween('now', '+30 years')->format('Y-m-d'),
        'leave_time' => 0,
        'reason' => $faker->text,
        'status' => '1',
        'leave_type' => 0,
        'second_app_id' => 1
    ];
});
