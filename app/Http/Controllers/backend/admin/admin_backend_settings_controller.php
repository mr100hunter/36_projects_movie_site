<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\management;
use App\Models\products;
use Illuminate\Support\Facades\File;
use App\Models\slider;
use App\Models\users;
use App\Models\live_tv;
use App\Models\products2;
use App\Models\download_links;
use App\Models\Sliders2;

class admin_backend_settings_controller extends Controller
{
    //admin_change_mangement_controller
    public function admin_change_mangement_controller(Request $req)
    {
        $data = $req -> all();
        $manage_data =  management::where('id', 1) -> first();

        if(!empty($req -> file('img1'))){
            $pic = $req -> file('img1');
            $pic_name1 = time().".".$pic -> getClientOriginalExtension();
            $pic -> move(public_path("images/contact"), $pic_name1);
        }else{
            $pic_name1 = $manage_data['img1'];
        }

        if(!empty($req -> file('img2'))){
            $pic = $req -> file('img2');
            $pic_name2 = time().".".$pic -> getClientOriginalExtension();
            $pic -> move(public_path("images/contact"), $pic_name2);
        }else{
            $pic_name2 = $manage_data['img2'];
        }

        if(!empty($req -> file('img3'))){
            $pic = $req -> file('img3');
            $pic_name3 = time().".".$pic -> getClientOriginalExtension();
            $pic -> move(public_path("images/contact"), $pic_name3);
        }else{
            $pic_name3 = $manage_data['img3'];
        }

        if(!empty($req -> file('logo'))){
            $pic = $req -> file('logo');
            $logo = time().".".$pic -> getClientOriginalExtension();
            $pic -> move(public_path("images/contact"), $logo);
        }else{
            $logo = $manage_data['logo'];
        }

        if(!empty($req -> file('bg'))){
            $pic = $req -> file('bg');
            $bg = time().".".$pic -> getClientOriginalExtension();
            $pic -> move(public_path("images/icons"), $bg);
        }else{
            $bg = $manage_data['bg'];
        }


        management::where('id', 1) -> update([
            "links1" => $data['links1'],
            "links2" => $data['links2'],
            "links3" => $data['links3'],
            "news" => $data['news'],
            "news2" => $data['news2'],

            "bg" => $bg,
            "logo" => $logo,
            "img1" => $pic_name1,
            "img2" => $pic_name2,
            "img3" => $pic_name3,
        ]);
        return back() -> with('msg', 'Your new link successfully updated!');
    }

    // admin_settings_content18_controller
    public function admin_settings_content18_controller($id)
    {
        $products = products::where('id', $id) -> first();

        products::where('id', $id) -> update([
            "content18" => $products['content18'] == "no" ? "yes" : "no"
        ]);
        return back() -> with('msg', 'Success updated!');
    }

    // admin_settings_products_add_controller
    public function admin_settings_products_add_controller(Request $req)
    {
        $pic = $req -> file('pic');
        $pic_name = time().".".$pic -> getClientOriginalExtension();
        $pic -> move(public_path("images/products"), $pic_name);


        $data = $req -> all();
        $db = new products;
        $db -> cat_id = $data['cat_id'];
        $db -> name = $data['name'];
        $db -> role = $data['role'];
        $db -> pic = $pic_name;
        $db -> links = $data['links'];
        $db -> content18 = !empty($data['content18']) ? $data['content18'] : "no";
        $db -> save();

        return back() -> with('msg', 'Success added!');
    }

    // admin_settings_products_update_img_controller
    public function admin_settings_products_update_img_controller(Request $req, $id)
    {
        $pic = $req -> file('pic');
        $pic_name = time().".".$pic -> getClientOriginalExtension();
        $pic -> move(public_path("images/products"), $pic_name);

        $productsData = products::where('id', $id) -> first();
        File::delete(public_path("images/products/".$productsData['pic']));

        products::where('id', $id) -> update([
            "pic" => $pic_name
        ]);
        return back() -> with('msg', 'Products img successfully updated!');
    }

    // admin_settings_products_update_content_controller
    public function admin_settings_products_update_content_controller(Request $req, $id)
    {
        $data = $req -> all();
        products::where('id', $id) -> update([
            "cat_id" => $data['cat_id'],
            "role" => $data['role'],
            "name" => $data['name'],
            "links" => $data['links'],
            "content18" => !empty($data['content18']) ? $data['content18'] : "no"
        ]);
        return back() -> with('msg', 'Products content successfully updated!');
    }

    // admin_settings_products_delete_controller
    public function admin_settings_products_delete_controller($id)
    {
        $productsData = products::where('id', $id) -> first();
        File::delete(public_path("images/products/".$productsData['pic']));
        products::where('id', $id) -> delete();
        return back() -> with('msg', 'Success deleted!');
    }

    // admin_settings_add_slider_controller
    public function admin_settings_add_slider_controller(Request $req)
    {
        $pic = $req -> file('img');
        $pic_name = time().".".$pic -> getClientOriginalExtension();
        $pic -> move(public_path("images/slider"), $pic_name);


        $data = $req -> all();
        $db = new slider;
        $db -> img = $pic_name;
        $db -> user_adult = $data['user_adult'];
        $db -> links = $data['links'];
        $db -> save();

        return back() -> with('msg', 'You are successfully add a new slider!');
    }

    // admin_settings_delete_slider_controller
    public function admin_settings_delete_slider_controller($id)
    {
        $productsData = slider::where('id', $id) -> first();
        File::delete(public_path("images/slider/".$productsData['pic']));
        slider::where('id', $id) -> delete();
        return back() -> with('msg', 'You are successfully delete a slider!');
    }

    // admin_settings_update_slider_controller
    public function admin_settings_update_slider_controller(Request $req, $id)
    {
        $productsData = slider::where('id', $id) -> first();

        if(!empty($req -> file('img'))){
            $pic = $req -> file('img');
            $pic_name = time().".".$pic -> getClientOriginalExtension();
            $pic -> move(public_path("images/slider"), $pic_name);
        }else{
            $pic_name = $productsData->img;
        }


        slider::where('id', $id) -> update([
            'img' => $pic_name,
            'links' => $req->links,
            "user_adult" => $req->user_adult
        ]);
        return back() -> with('msg', 'You are successfully updated a slider!'); 
    }
    public function admin_settings_update_slider_adult_controller(slider $slider)
    {
        $slider->user_adult = $slider->user_adult == 1 ? 0 : 1;
        $slider->save();
        return back() -> with('msg', 'You are successfully updated a slider!');
    }

    // admin_settings_add_slider2_controller
    public function admin_settings_add_slider2_controller(Request $req)
    {
        $pic = $req -> file('img');
        $pic_name = time().".".$pic -> getClientOriginalExtension();
        $pic -> move(public_path("images/slider"), $pic_name);


        $data = $req -> all();
        $db = new Sliders2;
        $db -> img = $pic_name;
        $db -> links = $data['links'];
        $db -> user_adult = $data['user_adult'];
        $db -> save();

        return back() -> with('msg', 'You are successfully add a new slider!');
    }

    // admin_settings_delete_slider2_controller
    public function admin_settings_delete_slider2_controller($id)
    {
        $productsData = Sliders2::where('id', $id) -> first();
        File::delete(public_path("images/slider/".$productsData['pic']));
        Sliders2::where('id', $id) -> delete();
        return back() -> with('msg', 'You are successfully delete a slider!');
    }

    // admin_settings_update_slider2_controller
    public function admin_settings_update_slider2_controller(Request $req, $id)
    {
        $productsData = Sliders2::where('id', $id) -> first();

        if(!empty($req -> file('img'))){
            $pic = $req -> file('img');
            $pic_name = time().".".$pic -> getClientOriginalExtension();
            $pic -> move(public_path("images/slider"), $pic_name);
        }else{
            $pic_name = $productsData->img;
        }


        Sliders2::where('id', $id) -> update([
            'img' => $pic_name,
            'links' => $req->links,
            "user_adult" => $req->user_adult
        ]);
        return back() -> with('msg', 'You are successfully updated a slider!');
    }
    public function admin_settings_update_slider2_adult_controller(Sliders2 $slider)
    {
        $slider->user_adult = $slider->user_adult == 1 ? 0 : 1;
        $slider->save();
        return back() -> with('msg', 'You are successfully updated a slider!');
    }

    // admin_settings_contact_links_add_controller
    public function admin_settings_search_urls_controller(Request $req)
    {
        $data = $req -> all();
        management::where('id', 1) -> update([
            "link_18" => $data['link_18'],
            "normal_link" => $data['normal_link'],

            "server2_18" => $data['server2_18'],
            "server2_normal" => $data['server2_normal'],

            "server3_18" => $data['server3_18'],
            "server3_normal" => $data['server3_normal'],
        ]);
        return back() -> with('msg', 'You are successfully update your search urls!');

    }

    // admin_settings_contact_links_add_controller
    public function admin_settings_contact_links_add_controller(Request $req)
    {
        $data = $req -> all();
        management::where('id', 1) -> update([
            "links" => $data['links']
        ]);
        return back() -> with('msg', 'You are successfully update your contact links!');

    }


    // admin_reseller_ban_controller
    public function admin_reseller_ban_controller($id)
    {
        users::where('creator_role', $id) -> update([
            "st" => "ban"
        ]);
        users::where('id', $id) -> update([
            "st" => "ban"
        ]);
        return back() -> with('msg', 'A reseller has ban with his users!');
    }

    // admin_reseller_delete_controller
    public function admin_reseller_delete_controller($id)
    {
        users::where('creator_role', $id) -> delete();
        users::where('id', $id) -> delete();
        return back() -> with('msg', 'A reseller has delete with his users!');
    }

    // admin_live_tv_add_controller
    public function admin_live_tv_add_controller(Request $req)
    {
        $data = $req -> all();
        if(!empty($req -> file('pic'))){
            $pic = $req -> file('pic');
            $pic_name = time().".".$pic -> getClientOriginalExtension();
            $pic -> move(public_path("images/products"), $pic_name);
        }

        $db = new live_tv;
        $db -> name = $data['name'];
        if(!empty($req -> file('pic'))){
            $db -> pic = $pic_name;
        }
        // links && expired
        $db -> links1 = $data['links1'];
        $db -> links2 = $data['links2'];
        $db -> links3 = $data['links3'];
        $db -> links4 = $data['links4'];

        $db -> expired1 = "00";//time()+($data['expired1']*60*60);
        $db -> expired2 = "00";//time()+($data['expired2']*60*60);
        $db -> expired3 = "00";//time()+($data['expired3']*60*60);
        $db -> expired4 = "00";//time()+($data['expired4']*60*60);

        $db -> content18 = !empty($data['content18']) ? $data['content18'] : "no";
        $db -> save();

        return back() -> with('msg', 'A movie links successfully added!');
    }

    // admin_settings_livetv_content18_controller
    public function admin_settings_livetv_content18_controller($id)
    {
        $live_tv = live_tv::where('id', $id) -> first();
        live_tv::where('id', $id) -> update([
            "content18" => $live_tv['content18'] == "no" ? "yes" : "no"
        ]);
        return back() -> with('msg', '18+ content status successfully updated!');
    }
    // admin_settings_livetv_delete_controller
    public function admin_settings_livetv_delete_controller($id)
    {
        $live_tv = live_tv::where('id', $id) -> first();
        File::delete(public_path("images/products/".$live_tv['pic']));
        live_tv::where('id', $id) -> delete();
        return back() -> with('msg', 'Success deleted!');
    }

    // admin_settings_livetv_update_controller
    public function admin_settings_livetv_update_controller(Request $req, $id)
    {
        $data = $req -> all();
        // img
        $img = $req -> file('img');
        if(!empty($img)){
            $file_name = time().".".$img->getClientOriginalExtension();
            $img -> move(public_path('images/products'), $file_name);
        }else{
            $old_data = live_tv::find($id);
            $file_name = $old_data['pic'];
        }

        live_tv::where('id', $id) -> update([
            "pic" => $file_name,
            "name" => $data['name'],
            "content18" => !empty($data['content18']) ? $data['content18'] : "no",
            "links1" => $data['links1'],
            "links2" => "1",
            "links3" => "1",
            "links4" => "1",
            "expired1" => "00",//time()+($data['expired1']*60*60),
            "expired2" => "00",//time()+($data['expired2']*60*60),
            "expired3" => "00",//time()+($data['expired3']*60*60),
            "expired4" => "00",//time()+($data['expired4']*60*60),

        ]);
        return back() -> with('msg', 'Live tv content successfully updated!'.$id);
    }

    /*
    ====================
        products 2
    ====================
    */
    // admin_settings_products2_add_controller
    public function admin_settings_products2_add_controller(Request $req)
    {
        $pic = $req -> file('pic');
        $pic_name = time().".".$pic -> getClientOriginalExtension();
        $pic -> move(public_path("images/products"), $pic_name);


        $data = $req -> all();
        $db = new products2;
        $db -> name = $data['name'];
        $db -> pic = $pic_name;
        $db -> links = $data['links'];
        $db -> content18 = !empty($data['content18']) ? $data['content18'] : "no";
        $db -> save();

        return back() -> with('msg', 'Success added!');
    }

    // admin_settings_products2_update_content_controller
    public function admin_settings_products2_update_content_controller(Request $req, $id)
    {
        $data = $req -> all();

        if(!empty($req -> file('pic'))){
            $pic = $req -> file('pic');
            $pic_name = time().".".$pic -> getClientOriginalExtension();
            $pic -> move(public_path("images/products"), $pic_name);
        }else{
            $products2Data = products2::where('id', $id) -> first();
            $pic_name = $products2Data['pic'];
        }
        products2::where('id', $id) -> update([
            "pic" => $pic_name,
            "name" => $data['name'],
            "links" => $data['links'],
            "content18" => !empty($data['content18']) ? $data['content18'] : "no"
        ]);
        return back() -> with('msg', 'Products2 content successfully updated!');
    }

    // admin_settings_products2_delete_controller
    public function admin_settings_products2_delete_controller($id)
    {
        $products2Data = products2::where('id', $id) -> first();
        File::delete(public_path("images/products/".$products2Data['pic']));
        products2::where('id', $id) -> delete();
        return back() -> with('msg', 'Success deleted!');
    }
    // admin_settings_content182_controller
    public function admin_settings_content182_controller($id)
    {
        $products = products2::where('id', $id) -> first();

        products2::where('id', $id) -> update([
            "content18" => $products['content18'] == "no" ? "yes" : "no"
        ]);
        return back() -> with('msg', 'Success updated!');
    }

    /*
    ====================
        UPDATE L
    ====================
    */
    // admin_settings_update_links_controller
    public function admin_settings_update_links_controller(Request $req)
    {
        $data = $req -> all();
        $old_data = download_links::where('id', 1) -> first();
        // video
        $video = $req -> file('video');
        if(!empty($video)){
            $file_name2 = time().".".$video->getClientOriginalExtension();
            $video -> move(public_path('video/movie'), $file_name2);
            // delete
            if(file_exists(public_path("video/movie/".$old_data['video']))){
                File::delete(public_path("video/movie/".$old_data['video']));
            }
        }else{
            $file_name2 = $old_data['video'];
        }
        download_links::where('id', 1) -> update([
            "main_title" => $data['main_title'],
            "video" => $file_name2,
            "file_name" => $data['file_name'],
            "file_size" => $data['file_size'],
            "download_btn" => $data['download_btn'],
            "download_links" => $data['download_links'],
        ]);
        return back() -> with('msg', 'Your movie links successfully updated!');
    }

    /*
    ====================
        Category
    ====================
    */
    // admin_settings_category_add_controller
    public function admin_settings_category_add_controller(Request $req)
    {

        $data = $req -> all();
        $db = new Category;
        $db -> role = $data['role'];
        $db -> name = $data['name'];
        $db -> link_18 = $data['link_18'];
        $db -> link_normal = $data['link_normal'];
        $db -> save();

        return back() -> with('msg', 'Success added!');
    }


    // admin_settings_category_delete_controller
    public function admin_settings_category_delete_controller($id)
    {
        $cat = Category::where('id', $id) -> first();
        products::where('cat_id', $cat->id) -> delete();
        Category::where('id', $id) -> delete();
        return back() -> with('msg', 'Success deleted!');
    }

    // admin_settings_category_update_controller
    public function admin_settings_category_update_controller(Request $req, $id)
    {
        $data = $req -> all();
        Category::where('id', $id) -> update([
            "name" => $data['name'],
            "role" => $data['role'],
            "link_18" => $data['link_18'],
            "link_normal" => $data['link_normal'],
        ]);
        return back() -> with('msg', 'Your movie links successfully updated!');
    }
    
    // admin_settings_category_st_controller
    public function admin_settings_category_st_controller(Category $id)
    {
        $id->st = $id->st == 1 ? 0 : 1;
        $id->save();
        return back() -> with('msg', 'Your category status successfully updated!');
    }

}
