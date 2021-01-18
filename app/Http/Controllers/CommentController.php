<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Comment;
use App\Models\UserCustomer;
use File;
use DateTime;
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();

class CommentController extends Controller
{

    
    // #########################################################################################################v#######
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

    public function list_comment(){
        $this->authenLogin();
        $all_comment = Comment::with('product')->with('customer')
            ->orderByDesc('comment_id')->paginate(25);
     
        return view('admin.Comment.list_comment')->with(compact('all_comment'));
    }

    public function delete_comment($param_comment_id){
        $this->authenLogin();
        Comment::find($param_comment_id)->delete();
        Session::put('message', "Delete Successfully!!!");
        return Redirect::to('/list-comment');
    }

    
    // #########################################################################################################v#######
    // ############################################CLIENT#####################################################v##########
    
    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::with('customer')->where('product_id', $product_id)->get();
        
        $output = '';

        foreach($comment as $key => $comment_value){
            $output .= '<div class="row comment">
                <div class="col-md-1">
                    <img src="'.url('/public/frontEnd/images/avatar.png').'" width="100%" class="img img-responsive img-thumbnail"/>
                </div>
                <div class="col-md-11">
                <p style="color:green;">@'.$comment_value->customer->customer_name.'</p>
                <p><i>'.$comment_value->comment_content.'</i></p>
                <p class="pull-right" style="font-size: 12px" ><i>'.$comment_value->created_at.'</i></p>
                </div>
                </div>
            ';
        }
        return $output;
    }

    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_content = $request->comment_content;
        $customer_id = $request->customer_id;

        $comment = new Comment();
        $comment->comment_content = $comment_content;
        $comment->product_id = $product_id;
        $comment->customer_id = $customer_id;
        $comment->created_at  = now();
        $comment->save();
    }
}
