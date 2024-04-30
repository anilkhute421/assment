<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

     $employee_list =   Permission::create([
            'name' => 'employee.list',
        ]);

       $employee_create =   Permission::create([
            'name' => 'employee.create',

        ]);

        $employee_edit =  Permission::create([
            'name' => 'employee.edit',
        ]);

        $employee_view =   Permission::create([
            'name' => 'employee.view',
        ]);

        $employee_delete =   Permission::create([
            'name' => 'employee.delete',
        ]);

        $admin_role = Role::create(['name' => 'admin']);
       

        $admin_role->givePermissionTo([
            $employee_list,
            $employee_create,
            $employee_edit,
            $employee_view,
            $employee_delete
        ]);


       $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password'  => Hash::make('password'),
        ]);


        $admin->assignRole($admin_role);

        $admin->givePermissionTo([
            $employee_list,
            $employee_create,
            $employee_edit,
            $employee_view,
            $employee_delete
        ]);

        $employee_role = Role::create(['name' => 'employee']);

        $employee_role->givePermissionTo([
            $employee_list,
        ]);

        $employee = User::create([
            'name' => 'employee1',
            'email' => 'employee1@gmail.com',
            'password'  => Hash::make('password'),
        ]);

        $employee->assignRole($employee_role);

        $employee->givePermissionTo([
            $employee_list,
        ]);


    }
}
