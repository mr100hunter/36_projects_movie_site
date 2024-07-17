<?php

namespace App\Http\Controllers\frontend\users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\products;
use App\Models\products2;
use App\Models\slider;
use App\Models\users;
use App\Models\live_tv;
use App\Models\management;
use App\Models\download_links;
use App\Models\Sliders2;

class users_frontend_deshbord_controller extends Controller
{
    //users_home_controller
    public function users_home_controller(Request $request, $id=null)
    {
        $userData = users::where('username', $request -> session() -> get('username')) -> first();
        $management = management::where('id', 1) -> first();
        $cat = Category::orderBy('role', 'ASC')->where('st', 1)->get();
        $cat_f = Category::orderBy('role', 'ASC')->where('st', 1)->first();
        if(empty($id)){
            if($request->session()->has('id')){
                $id=$request->session()->get('id');
            }else{
                $id=$cat_f->id;
            }
        }
        $cat_r = Category::find($id);
        
        if($request -> session() -> has('content18')){
            if($userData['user_adult'] == "yes"){
                $products = products::orderBy('role', 'ASC') -> where('cat_id', $id) -> get();
            }else{
                $products = products::orderBy('role', 'ASC') -> where('cat_id', $id) -> where("content18", "no") -> get();
            }
        }else{
            if($userData['user_adult'] == "yes"){
                $products = products::orderBy('role', 'ASC') -> where('cat_id', $id) -> where('content18', 'no') -> get();
            }else{
                $products = products::orderBy('role', 'ASC') -> where('cat_id', $id) -> where("content18", "no") -> where('content18', 'no') -> get();
            }
        }


        // slider
        if($userData['slider'] == "Slider 1"){
            $slider = slider::orderBy('id', 'DESC') -> get();
        }else{
            $slider = Sliders2::orderBy('id', 'DESC') -> get();
        }

        // where
        $where = "server1";

        if(($userData['access'] != "all") && ($userData['access'] != "server1") && ($userData['access'] != "server12")){
            return redirect(route('users_livetv_web'));
        }

        return view('users.pages.home.home') -> with(compact('products', 'slider', 'userData', 'where', 'management', 'cat', 'id', 'cat_f', 'cat_r'));
    }
    
    // users_note_controller
    public function users_note_controller(Request $request)
    {
        $userData = users::where('username', $request -> session() -> get('username')) -> first();
        $management = management::where('id', 1) -> first();
        
        return view('users.pages.home.note') -> with(compact('userData', 'management'));
    }

    // users_livetv_controller
    public function users_livetv_controller(Request $request)
    {
        $management = management::where('id', 1) -> first();
        $userData = users::where('username', $request -> session() -> get('username')) -> first();
        if($request -> session() -> has('content18')){
            if($userData['user_adult'] == "yes"){
                $products = live_tv::orderBy('id', 'DESC') -> get();
            }else{
                $products = live_tv::orderBy('id', 'DESC') -> where("content18", "no") -> get();
            }
        }else{
            if($userData['user_adult'] == "yes"){
                $products = live_tv::orderBy('id', 'DESC') -> where('content18', 'no') -> get();
            }else{
                $products = live_tv::orderBy('id', 'DESC') -> where("content18", 'no') -> where('content18', 'no') -> get();
            }
        }
        // slider
        if($userData['slider'] == "Slider 1"){
            $slider = slider::orderBy('id', 'DESC') -> get();
        }else{
            $slider = Sliders2::orderBy('id', 'DESC') -> get();
        }
        // where
        $where = "live";

        return view('users.pages.home.home') -> with(compact('products', 'slider', 'userData', 'where', 'management'));
    }

    // users_server2tv_controller
    public function users_server2tv_controller(Request $request)
    {
        $management = management::where('id', 1) -> first();
        $userData = users::where('username', $request -> session() -> get('username')) -> first();
        if($request -> session() -> has('content18')){
            if($userData['user_adult'] == "yes"){
                $products = products2::orderBy('id', 'DESC') -> get();
            }else{
                $products = products2::orderBy('id', 'DESC') -> where("content18", "no") -> get();
            }
        }else{
            if($userData['user_adult'] == "yes"){
                $products = products2::orderBy('id', 'DESC') -> where('content18', 'no') -> get();
            }else{
                $products = products2::orderBy('id', 'DESC') -> where("content18", 'no') -> where('content18', 'no') -> get();
            }
        }
        // slider
        if($userData['slider'] == "Slider 1"){
            $slider = slider::orderBy('id', 'DESC') -> get();
        }else{
            $slider = Sliders2::orderBy('id', 'DESC') -> get();
        }
        // where
        $where = "server2";

        return view('users.pages.home.home') -> with(compact('products', 'slider', 'userData', 'where', 'management'));
    }

    // users_update_controller
    public function users_update_controller() {
        $management = download_links::where('id', 1) -> first();
        return view('users.pages.home.update') -> with(compact('management'));
    }

    // users_404_controller
    public function users_404_controller(Request $request)
    {
        return view('users.pages.home.404');
    }

}
