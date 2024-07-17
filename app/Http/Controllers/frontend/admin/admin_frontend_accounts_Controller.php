<?php

namespace App\Http\Controllers\frontend\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class admin_frontend_accounts_Controller extends Controller
{
    //admin_accounts_controller
    public function admin_accounts_controller()
    {
        return view('admin.pages.accounts.login');
    }
}
