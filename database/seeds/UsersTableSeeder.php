<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_staff = Role::where('name', 'staff')->first();
        $role_employee = Role::where('name', 'employee')->first();
        $role_manager  = Role::where('name', 'manager')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $admin = new User();
        $admin->name = 'Admin Name';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('secret');
        $admin->weight = 1;
        $admin->save();
        $admin->roles()->attach($role_admin);

        $employee = new User();
        $employee->name = 'Employee Name';
        $employee->email = 'employee@example.com';
        $employee->password = bcrypt('secret');
        $employee->weight = 2;
        $employee->save();
        $employee->roles()->attach($role_employee);

        $manager = new User();
        $manager->name = 'Manager Name';
        $manager->email = 'manager@example.com';
        $manager->password = bcrypt('secret');
        $manager->weight = 3;
        $manager->save();
        $manager->roles()->attach($role_manager);

        $staff = new User();
        $staff->name = 'Staff Name';
        $staff->email = 'staff@example.com';
        $staff->password = bcrypt('secret');
        $staff->weight = 4;
        $staff->save();
        $staff->roles()->attach($role_staff);
    }
}
