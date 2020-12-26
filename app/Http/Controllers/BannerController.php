<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
date_default_timezone_set('Asia/Ho_Chi_Minh');
use DateTime;
session_start();

class BannerController extends Controller
{

    // #########################################################################################################v#######
    // ###########################################ADMIN#####################################################v##########
    // Check đăng nhập
    public function authenLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
           return Redirect::to('/dashboard');
        }else{
           return Redirect::to('/admin')->send();
        }
    }


    public function add_banner(Request $request){
        $this->authenLogin();
        $this->validation($request);
        $data = $request->all();

        $banner = new Banner();
        $banner->banner_name  = $data['name_banner']; // "banner_name" là tên cột trong database -- "name_banner" là name trong html
        $banner->banner_status  = $data['status_banner'];
        $banner->created_at  = now();
        $get_image = $request->file('image_banner');     

        if($get_image){
            $today = Carbon::today();  
            $month = $today->monthName;      
            $day = $today->day;

            $get_name_image = $get_image->getClientOriginalName(); //Get name của image tải lên
            $name_image = current(explode('.', $get_name_image)); // tách chuỗi theo dấu chấm nếu không file ảnh sẽ là Gallery.jpg.12.png là ăn
            //$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $new_image = $name_image.'-'.$month.'-'.$day.'-'.time().'.'.$get_image->getClientOriginalExtension(); // tên ảnh cuối cùng
            $get_image->move('public/upload/banners', $new_image);

            $banner->banner_image  = $new_image;
            $banner->save();
            Session::put('message', "Insert Successfully!!!");
            return Redirect::to('/list-banner');
        }else{
            $banner->banner_image  ="";
            $banner->save();
            Session::put('message', "Something went wrong!!!");
            return Redirect::to('/list-banner');
        }
    }

    public function list_banner(){
        $this->authenLogin();
        $banner = Banner::orderby('banner_id', 'DESC')->paginate(10);
        return view('/admin.Banner.list_banner')->with(compact('banner'));
    }

    public function delete_banner($param_banner_id){
        $this->authenLogin();
        $banner = Banner::find($param_banner_id);
        $banner_image = $banner->banner_image;
        unlink('public/upload/banners/' .$banner_image);
        $banner->delete();
        Session::put('message', "Delete Successfully!!!");
        return redirect()->back();
    }


    public function active_status_banner($param_banner_id){
        $this->authenLogin();
        $get_banner_name = Banner::where('banner_id', $param_banner_id)->select('banner_name')->first();
        Banner::where('banner_id', $param_banner_id)->update(['banner_status'=>0]);
        Session::put('message_status', "Hidden " .'"'."'$get_banner_name->banner_name'".'"');
        return Redirect::to('/list-banner');  
    }

    public function unactive_status_banner($param_banner_id){
        $this->authenLogin();
        $get_banner_name =  Banner::where('banner_id', $param_banner_id)->select('banner_name')->first();
        Banner::where('banner_id', $param_banner_id)->update(['banner_status'=>1]);
        Session::put('message_status', "Showed " .'"'."'$get_banner_name->banner_name'".'"');
        return Redirect::to('/list-banner');
    }

    public function validation($request){
        return $this->validate($request,[
           'name_banner' => ['required', 'max:255'],
        ]);
     }

    // #########################################################################################################v#######
    // ###########################################CLIENT#####################################################v##########
}
