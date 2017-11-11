<?php

use Illuminate\Database\Seeder;
use App\User;
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
        User::create(['name' => 'Daniel Dickson', 'email' => 'ninjadd@gmail.com', 'password' => bcrypt('6891ninja')]);

        $faker = Faker::create();

        foreach (range(1, 49) as $item) {
            $user = new User();
            $user->name = $faker->name();
            $user->email = $faker->email;
            $user->password = bcrypt('secret');
            $user->save();
        }
    }
}
