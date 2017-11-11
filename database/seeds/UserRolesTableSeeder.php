<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserRole;
use Faker\Factory as Faker;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (User::all() as $user) {
            $userRole = new UserRole();
            $userRole->user_id = $user->id;
            $userRole->name = $faker->randomElement(['CEO', 'CTO', 'COO']);
            $userRole->description = $faker->paragraph('3', true);
            $userRole->weight = $faker->randomElement([1, 2, 3, 4]);
            $userRole->save();
        }
    }
}
