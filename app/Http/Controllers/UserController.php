<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function admin_index() {
        $users = User::where('is_admin', false)->get();
        return view('admin_users.index')->with('users', $users);
    }

    public function admin_show(User $user) {
        return view('admin_users.show')->with('user', $user);
    }

    public function admin_update(Request $request, User $user) {

        $request->validate([
            'name'         => 'required',
            'email'        => 'required',
            'phone_number' => 'required',
            'address'      => 'required',
        ]);

        $data_user   = $request->only(['name', 'email']);
        $data_detail = $request->only(['phone_number', 'address']);

        if ($request['password'] != null) {
            $data_user['password'] = $request['password'];
        }

        $user->update($data_user);
        $user->user_detail()->update($data_detail);

        return redirect( route('admin.users.index') );
    }

    public function client_account_detail() {
        $user = Auth::user();
        return view('auth\account-details')->with('user', $user);
    }

    public function client_account_update(Request $request) {
        $request->validate([
            'name'         => 'required',
            'email'        => 'required',
            'phone_number' => 'required',
            'address'      => 'required',
        ]);

        $data_user   = $request->only(['name', 'email']);
        $data_detail = $request->only(['phone_number', 'address']);

        Auth::user()->update($data_user);
        Auth::user()->user_detail()->update($data_detail);
        return redirect( route('client.home') );
    }

}
