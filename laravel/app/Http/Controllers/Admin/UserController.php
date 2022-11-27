<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create_user_view(Request $request)
    {
        $role = Role::get();
        return view('admin.create_user', compact('role'));
    }

    public function save_user(Request $request)
    {

        // return count($request->role);
        try {
            $add = new User;
            $add->name = $request->name;
            $add->email = $request->email;
            $add->password = Hash::make('password');
            if ($add->save()) {
                for ($i = 0; $i < count($request->role); $i++) {
                    $role = new UserRole;
                    $role->role_id = $request->role[$i];
                    $role->user_id = $add->id;
                    $role->save();
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                toastr()->warning('Duplicate Email Entry!');
                // dd('Duplicate Entry');
            }
        }

        return redirect()->route('admin.home');
    }

    public function get_user(Request $request)
    {
        $role_id = $request->role_id;

        $uI = UserRole::where(['role_id' => $role_id])->get();
        foreach ($uI as $key => $value) {
            $user[] = $value->user_id;
        }

        $all = User::whereIn('id', $user)->get();

        $html = "";
        $html .= '<div class="card-header">Get User</div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
';

        foreach ($all as $key => $value) {
            $html .= '
           <tr>
                                <th scope="row">' . ++$key . '</th>
                                <td>' . $value->name . '</td>
                                <td>' . $value->email . '</td>
                            </tr>
';
        }

        $html .= '</tbody>
        </table>
';

        return $html;
    }

    public function get_user_view()
    {
        $role = Role::get();
        return view('admin.get_user_view', compact('role'));
    }
}
