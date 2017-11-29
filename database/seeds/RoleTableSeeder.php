<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'A TAB User';
        $role->save();

        $role = new Role();
        $role->name = 'manager';
        $role->description = 'A Manager User';
        $role->save();

        $role = new Role();
        $role->name = 'employee';
        $role->description = 'A Employee User';
        $role->save();

        $role = new Role();
        $role->name = 'staff';
        $role->description = 'A Staff User';
        $role->save();
    }
}
