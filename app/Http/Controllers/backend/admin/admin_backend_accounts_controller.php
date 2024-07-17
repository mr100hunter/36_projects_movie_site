<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users;

class admin_backend_accounts_controller extends Controller
{
    //admin_login_controller
    public function admin_login_controller(Request $req)
    {
        $data = $req -> all();
        if(\App\Models\users::where('username', $data['username'])  ->where(function ($query) {
            $query->where('role', '1')
                ->orWhere('role', '2');
        }) -> exists()){
            $req -> session() -> put('username', $data['username']);
            return redirect(route('users.admin_all_web'));
        }
        return back() -> with('msg', 'Invalid info');
    }
}
