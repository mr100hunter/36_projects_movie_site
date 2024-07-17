<?php

namespace App\Http\Controllers\frontend\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users;

class admin_frontend_reseller_controller extends Controller
{
    //admin_reseller_all_controller
    public function admin_reseller_all_controller(Request $req)
    {
        users::where('expired', '<', time()) -> where('role', '0') -> delete();
        $userData = users::orderBy('id', 'DESC') -> where('st', 'active') -> where('role', '2') -> paginate(10);
        return view('admin.pages.reseller.all') -> with(compact('userData'));
    }

    //admin_reseller_ban_controller
    public function admin_reseller_ban_controller(Request $req)
    {
        users::where('expired', '<', time()) -> where('role', '0') -> delete();
        $userData = users::orderBy('id', 'DESC') -> where('st', 'ban') -> where('role', '2') -> paginate(10);
        return view('admin.pages.reseller.ban') -> with(compact('userData'));
    }
}
