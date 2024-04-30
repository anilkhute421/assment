<?php

namespace App\Repositries;

use App\Helper\CommonHelper;
use App\Models\UserDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeRepository
{
    // employee will be created and also sending welcome email message.
    public function employee_create($request)
    {
        if (!Auth::user()->hasPermissionTo('employee.create')) {
            CommonHelper::sendError('Unauthorized action.', [], 403);
        }

        $user = User::create([
            "name" => $request['name'],
            "email" => $request['email'],
            "password" => Hash::make($request['password']),
        ]);

        $user_details = UserDetail::create([
            "building_no" => $request['building_no'],
            "street_name" => $request['street_name'],
            "city" => $request['city'],
            "state" => $request['state'],
            "country" => $request['country'],
            "pincode" => $request['pincode'],
            "user_id"  => $user->id,
        ]);

        $user_role = Role::where('name', $request['role_name'])->first();

        if ($user_role) {
            $user->assignRole($user_role);
            $permissions = $user_role->permissions->pluck('name')->toArray();

            $user['permissions'] = $permissions;
        }

        //dispatch our job for sending message.
        dispatch(new \App\Jobs\SendMailJob($user));

        return $user;
    }


    // employee data will be listed here.
    public function employee_list()
    {
        if (!Auth::user()->hasPermissionTo('employee.list')) {
            CommonHelper::sendError('Unauthorized action.', [], 403);
        }

        $user = User::with('user_detail')->get();

        return $user;
    }


    // employee data will be view here.
    public function employee_view($request)
    {
        if (!Auth::user()->hasPermissionTo('employee.view')) {
            CommonHelper::sendError('Unauthorized action.', [], 403);
        }

        $user = User::with('user_detail')->where("id", $request['user_id'])->first();

        return $user;
    }

    
    // employee data will be update here.
    public function employee_update($request)
    {
        if (!Auth::user()->hasPermissionTo('employee.update')) {
            CommonHelper::sendError('Unauthorized action.', [], 403);
        }

        $user = User::where('id', $request['user_id'])->first();

        if ($user) {
            $user->update([
                "name" => $request['name'],
                "email" => $request['email'],
            ]);

            $user_detail = UserDetail::where('user_id', $request['user_id'])->update([

                "building_no" => $request['building_no'],
                "street_name" => $request['street_name'],
                "city" => $request['city'],
                "state" => $request['state'],
                "country" => $request['country'],
                "pincode" => $request['pincode'],
            ]);

            $user->removeRole($user->roles->first());

            $user_role = Role::where('name', $request['role_name'])->first();
            if ($user_role) {
                $user->assignRole($user_role);
            }

            $user->refresh();
        }

        return $user;
    }
}
