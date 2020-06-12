<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i=0; $i < 15; $i++) { 
            $data[$i] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('123'),
                'avatar' => 'avatars/default.png',
                'address' => $faker->address,
                'phone' => $faker->PhoneNumber(),
                'roles' => 'User',
                'remember_token' => Str::random(10)
            ];
        }
        DB::table('users')->insert($data);
    }
}
