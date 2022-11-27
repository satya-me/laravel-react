<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class APIController extends Controller
{
    public function save_user(Request $request)
    {
        // return "satya";
        // return $request;

        // return count($request->role);
        try {
            $add = new User;
            $add->name = $request->name;
            $add->email = $request->email;
            $add->password = Hash::make('password');
            if ($add->save()) {
                $role = new UserRole;
                $role->role_id = $request->role;
                $role->user_id = $add->id;
                $role->save();
                // for ($i = 0; $i < count($request->role); $i++) {
                // }
                $msg = 'User saved successfully';
                $flag = true;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                $msg = 'Duplicate Email Entry!';
                $flag = false;
                // dd('Duplicate Entry');
            }
        }

        return response()->json([
            'resp' => $msg,
            'flag' => $flag
        ]);
    }

    public function get_role()
    {
        return Role::get();
    }

    public function get_user_by_id(Request $request)
    {
        // return $request->role;


        $role_id = $request->role;

        $uI = UserRole::where(['role_id' => $role_id])->get();
        foreach ($uI as $key => $value) {
            $user[] = $value->user_id;
        }

        return $all = User::whereIn('id', $user)->get();
    }
}
