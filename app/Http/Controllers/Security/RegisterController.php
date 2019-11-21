<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Sentinel;
use App\Models\Roles\RoleModel;

class RegisterController extends Controller
{
    public function register() {
        $data['roles'] = RoleModel::get();
        return view('security.register')->with('data', $data);
    }

    public function registerUser(Request $request) {

        $data = $request->all();
        $roleId = $data['role'];

        $user = Sentinel::registerAndActivate($data);
        $role = Sentinel::findRoleById($roleId);

        $role->users()->attach($user);
        return redirect(url('/'));
    }
}
