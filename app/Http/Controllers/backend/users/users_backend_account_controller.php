<?php

namespace App\Http\Controllers\backend\users;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\loging_log;

class users_backend_account_controller extends Controller
{
    //users_users_login_controller
    public function users_users_login_controller(Request $req)
    {
        $data = $req -> all();

        // browser_cache
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $start_pos = strpos($user_agent, "(");
        $end_pos = strpos($user_agent, ")", $start_pos);
        $uniq = substr($user_agent, $start_pos + 1, $end_pos - $start_pos - 1);

        // username check
        if(!users::where('username', $data['username']) -> exists()){
            return response() -> json(['st' => false, 'msg' => 'Invalid Credentials']);
        }

        // user data
        $userData = users::where('username', $data['username']) -> first();

        // expired
        if(users::where('username', $data['username']) -> where('expired', '<', time()) -> exists()){
            loging_log::where('username', $data['username'])->delete();
            Device::where('username', $data['username'])->delete();
            
            return response() -> json(['st' => false, 'msg' => 'Your id is expired.']);
        }

        // is ban
        if(users::where('username', $data['username']) -> where('st', 'ban') -> exists()){
            return response() -> json(['st' => false, 'msg' => 'Your id is ban.']);
        }

        // browser_cache
        $allDevice = Device::where('username', $data['username'])->pluck('device')->toArray();
        if(in_array($uniq, $allDevice)){
            if(users::where('username', $data['username']) -> exists()){
                $device =  Device::where('username', $data['username'])->where('device', $uniq)->first();

                // login history
                $db = new loging_log;
                $db -> username = $data['username'];
                $db -> city = $data['city'];
                $db -> device_id = $device['id'];
                $db -> ip = $data['ip'];
                $db -> loc = $data['loc'];
                $db -> browser_id = $uniq;
                $db -> save();

                $req -> session() -> put('username', $data['username']);

                return response() -> json(['st' => true]);
            }
        }

        // login_time & new device
        if(users::where('username', $data['username']) -> where('login_time', '>', 0) -> exists()){
            $user = users::where('username', $data['username'])->first();

            users::where('username', $data['username']) -> update([
                'login_time' => $userData['login_time'] - 1,
            ]);
            // device
            $device = new Device;
            $device -> user_id = $user->id;
            $device -> username = $data['username'];
            $device -> device = $uniq;
            $device -> save();

            // login history
            $login = new loging_log;
            $login -> username = $data['username'];
            $login -> device_id = $device->id;
            $login -> city = $data['city'];
            $login -> ip = $data['ip'];
            $login -> loc = $data['loc'];
            $login -> browser_id = $uniq;
            $login -> save();



            $req -> session() -> put('username', $data['username']);

            return response() -> json(['st' => true]);
        }else{
            return response() -> json(['st' => false]);

        }
    }

    // users_users_logout_controller
    public function users_users_logout_controller(Request $req)
    {
        $req -> session() -> forget('username');
        return back();
    }
}
