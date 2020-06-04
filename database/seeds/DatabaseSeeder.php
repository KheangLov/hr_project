<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // DB::table('roles')->insert([
        //     ['name' => 'admin'],
        //     ['name' => 'user']
        // ]);

        DB::table('departments')->insert([
            ['name' => 'Web']
        ]);

        DB::table('units')->insert([
            [
                'name' => 'Develop',
                'department_id' => 1
            ]
        ]);

        DB::table('groups')->insert([
            [
                'name' => 'Sonin',
                'unit_id' => 1
            ]
        ]);

        DB::table('positions')->insert([
            [
                'name' => 'Manager',
                'role' => 1
            ]
        ]);

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'name_khmer' => 'អេតមីន',
                'gender' => 'male',
                'dob' => '2000-10-02',
                'status' => '1',
                'email' => 'admin@gmail.com',
                'email_verified_at' => $faker->dateTime($max = 'now', $timezone = null),
                'password' => bcrypt('not4you'),
                'role_id' => 1,
                'annual_leave' => 18,
                'back_account' => '123213213213',
                'salary' => 1000,
                'address' => 'wqewqewqewqewqewqe',
                'department_id' => 1,
                'unit_id' => 1,
                'position_id' => 1,
                'group_id' => 1,
                'start_date' => $faker->dateTime($max = 'now', $timezone = null),
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
            ]
        ]);
    }
}
