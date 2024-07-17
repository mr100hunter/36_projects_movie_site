<?php

namespace App\Http\Controllers\frontend\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\management;

class users_frontend_accounts_controller extends Controller
{
    //users_accounts_controller
    public function users_accounts_controller()
    {
        $data = management::where('id', 1) -> first();
        return view('users.pages.accounts.login') -> with(compact('data'));
    }
}
