<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Visitor;
use Dotenv\Validator;
use App\Rules\Captcha;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use DateTime;
date_default_timezone_set('Asia/Ho_Chi_Minh');
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

    public function show_dashboard(Request $request){
        $this->authenLogin();

        // ########################## ACCESS TIMES
        //Get user Current online
        $ip_address = $request->ip();
        $visitor_current = Visitor::where("visitor_ip", $ip_address)->get();
        $count_current = $visitor_current->count();
        
        //Get datetime
        $today = Carbon::now();
        $start_thisday = Carbon::now('Asia/Ho_Chi_Minh')->startOfDay()->toDateString();
        $start_thisweek = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->toDateString();
        $start_thismonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();

        //Query
        $count_visitor = Visitor::all()->count();
        $accessTime_today = Visitor::whereBetween('visitor_date', [$start_thisday, $today])->count();
        $accessTime_week = Visitor::whereBetween('visitor_date', [$start_thisweek, $today])->count();
        $accessTime_month = Visitor::whereBetween('visitor_date', [$start_thismonth, $today])->count();

        //################################## RESOURCE
        $count_product = Product::all()->count();
        $count_cate = Category::all()->count();
        $count_brand = Brand::all()->count();
        $count_order = Order::all()->count();

        return view('admin.admin_dashboard')
        ->with(compact('count_visitor', 'accessTime_today', 'accessTime_week', 'accessTime_month', 'count_current',
                        'count_product', 'count_cate', 'count_brand', 'count_order'));
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

   public function register(){
      return view('/admin_register');
   }

   public function admin_register(Request $request){
      $this->validation($request);
      $data = $request->all();
      
      $admin_password = $data['admin_password'];
      $admin_repassword = $data['admin_repassword'];
      if($admin_password == $admin_repassword){
        $admin = new Admin();
        $admin->admin_name  = $data['admin_name'];
        $admin->admin_phone  = $data['admin_phone'];
        $admin->admin_email  = $data['admin_email'];
        $admin->admin_password  = md5($data['admin_password']);
        $admin->created_at = now();
        $admin->save();    
        return Redirect::to('/admin')->with('message', "Signed up Successfully!");;
      }else{
        return redirect()->back()->with('error', "Sign up Failed!");
      }
      
   }

   // Logout
   public function admin_logout(){
      $this->authenLogin();
      Session::put('admin_name', null);
      Session::put('admin_id', null);
      return Redirect::to('/admin');
   }

   public function validation($request){
      return $this->validate($request,[
         'admin_name' => ['required', 'max:255'],
         'admin_phone' => ['required', 'max:255'],
         'admin_email' => ['required', 'email', 'max:255'],
         'admin_password' => ['required', 'max:255'],
         'admin_repassword' => ['required', 'max:255'],
      ]);
   }
}
