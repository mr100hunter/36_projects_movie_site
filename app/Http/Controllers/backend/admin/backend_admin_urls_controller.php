<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\urls;

class backend_admin_urls_controller extends Controller
{
    //admin_urls_add_urls_controller
    public function admin_urls_add_urls_controller(Request $req) {
        $data = $req -> all();

        // is key is used
        if(urls::where("uniqeKey", $data['uniqeKey']) -> exists()){
            return back() -> with('msg', 'Uniqe key is already use!');
        }

        $db = new urls;
        $db -> uniqeKey = $data['uniqeKey'];
        $db -> url = $data['url'];
        $db -> save();
        return back() -> with('msg', 'You are successfully create a sorten url!!');
    }

    // admin_urls_update_urls_controller
    public function admin_urls_update_urls_controller(Request $req, $id){
        $data = $req -> all();

        // is key is used
        if(urls::where("uniqeKey", $data['uniqeKey']) -> where('id', '!=', $id) -> exists()){
            return back() -> with('msg', 'Uniqe key is already use!');
        }

        urls::where("id", $id) -> update([
            "uniqeKey" => $data['uniqeKey'],
            "url" => $data['url'],
        ]);
        return back() -> with('msg', 'You are successfully update a sorten url!!');
    }

    // admin_urls_delete_urls_controller
    public function admin_urls_delete_urls_controller($id) {
        urls::where("id", $id) -> delete();
        return redirect(route('settings.urls_admin_urls_web')) -> with('msg', 'You are successfully delete a sorten url!!');
    }

    // admin_urls_search_controller
    public function admin_urls_search_controller(Request $req) {
        $data = $req -> all();

        $urls_data = urls::where("uniqeKey", "LIKE", "%".$data['url']."%") -> get();
        return response() -> json(['data' => $urls_data]);
    }
}
