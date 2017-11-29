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
        $role->name = 'master';
        $role->description = 'A TAB User';
        $role->save();

        $role = new Role();
        $role->name = 'admin';
        $role->description = 'The primary on the account can add, edit and delete Users and all parts of the Organization';
        $role->save();

        $role = new Role();
        $role->name = 'manager';
        $role->description = 'User who can add, edit and delete Users in his portion of the Org';
        $role->save();

        $role = new Role();
        $role->name = 'employee';
        $role->description = 'User can update own user profile and view all parts of the Org and send communications throughout the Org ';
        $role->save();

        $role = new Role();
        $role->name = 'staff';
        $role->description = 'Can view all parts and send communications throughout the Org';
        $role->save();
    }
}
