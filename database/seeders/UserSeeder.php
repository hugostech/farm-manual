<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@lincoln.ac.nz',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => $faker->name,
            'email' => 'user@lincoln.ac.nz',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('groups')->insert([
            'id' => 1,
            'name' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('groups')->insert([
            'id' => 2,
            'name' => 'subscriber',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('user_to_groups')->insert([
            'id' => 1,
            'user_id' => 1,
            'group_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('user_to_groups')->insert([
            'id' => 2,
            'user_id' => 2,
            'group_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        for ($i = 3; $i < 30; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('user_to_groups')->insert([
                'user_id' => $i,
                'group_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
