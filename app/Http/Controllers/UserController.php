<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\UserCustomer;
date_default_timezone_set('Asia/Ho_Chi_Minh');
use DateTime;
session_start();


class UserController extends Controller
{
    // ############################################ADMIN#####################################################v##########
    // Check đăng nhập
    public function authenLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
           return Redirect::to('/dashboard');
        }else{
           return Redirect::to('/admin')->send();
        }
    }

    public function list_user(){
        $this->authenLogin();
        $all_user = UserCustomer::orderBy('customer_id', 'DESC')->paginate(10);
        return view('admin.User.list_user')->with(compact('all_user'));
    }
}
