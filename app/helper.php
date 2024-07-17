<?php 

function admin_data($username){
    return \App\Models\users::where("username", $username)-> first();
}