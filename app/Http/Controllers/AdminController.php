<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Admin;
use Dotenv\Validator;
use App\Rules\Captcha;
session_start();

class AdminController extends Controller
{
   // Check đăng nhập
   public function authenLogin(){
      $admin_id = Session::get('admin_id');
      if($admin_id){
         return Redirect::to('/dashboard');
      }else{
         return Redirect::to('/admin')->send();
      }
   }

    public function admin(){
       return view('admin_login');
    }

    public function show_dashboard(){
        $this->authenLogin();
        return view('admin.admin_dashboard');
     }

     // Login
     public function admin_login(Request $request){
      $data = $request->validate([
         'admin_email' => 'required',
         'admin_password' => 'required',
         'g-recaptcha-response' => new Captcha(), 		//dòng kiểm tra Captcha( tên trong admin_login.blade.php dòng 50)
      ]);

      $admin_email = $request->admin_email;
      $admin_password = md5($request->admin_password);

      $result = Admin::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first(); // First() là lấy 1 value
      //return view('Admin.admin_dashboard');
      if($result){
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
      }else{
            Session::put('message', 'Wrong password!');
            return Redirect::to('/admin');
      }
   }

   // Logout
   public function admin_logout(){
      $this->authenLogin();
      Session::put('admin_name', null);
      Session::put('admin_id', null);
      return Redirect::to('/admin');
   }
}
