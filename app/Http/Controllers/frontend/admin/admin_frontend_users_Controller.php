<?php

namespace App\Http\Controllers\frontend\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\Device;

class admin_frontend_users_Controller extends Controller
{
    //admin_users_all_controller
    public function admin_users_all_controller(Request $request)
    {
        users::where('expired', '<', time()) -> where('role', '0') -> delete();
        $adminData = users::where("username", $request -> session() -> get('username'))-> first();
        $userData = users::orderBy('id', 'DESC') -> where('st', 'active') -> where('role', '0') -> where('creator_role', $adminData['id']) -> paginate(10);
        return view('admin.pages.users.all') -> with(compact('userData'));
    }

    // admin_users_ban_controller
    public function admin_users_ban_controller()
    {
        $userData = users::orderBy('id', 'DESC') -> where('st', 'ban') -> where('role', '0') -> paginate(10);
        return view('admin.pages.users.ban') -> with(compact('userData'));
    }

    // admin_users_add_controller
    public function admin_users_add_controller()
    {
        return view('admin.pages.users.add');
    }

    // admin_users_update_controller
    public function admin_users_update_controller($id)
    {
        $data = users::where('id', $id) -> first();
        $devices = Device::where('username', $data['username'])->latest()->get();
        return view('admin.pages.users.update') -> with(compact('data', 'id', 'devices'));
    }
}
