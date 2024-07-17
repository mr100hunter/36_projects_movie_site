<?php

namespace App\Http\Controllers\frontend\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\urls;

class admin_frontend_urls_controller extends Controller
{
    //admin_urls_links_controller
    public function admin_urls_links_controller($uniqeKey=null) {
        // check url 
        if(!empty($uniqeKey)){
            if(urls::where("uniqeKey", $uniqeKey) -> exists()){
                $first_urls = urls::where("uniqeKey", $uniqeKey) -> first();
                urls::where("uniqeKey", $uniqeKey) -> update([
                    "view" => $first_urls['view'] + 1
                ]);
                return redirect($first_urls['url']);
            }else{
                return view('users.pages.home.404');
            }
        }
        return redirect(route('users_home_web'));
    }

    // admin_urls_controller
    public function admin_urls_controller() {
        $first_urls = "disabled";
        if(isset($_REQUEST['up'])){
            $first_urls = urls::where("id", $_REQUEST['up']) -> first();
        }
        $urls = urls::orderBy('id', 'DESC') -> paginate(10);
        return view('admin.pages.settings.urls.url') -> with(compact('urls', 'first_urls'));
    }

}
