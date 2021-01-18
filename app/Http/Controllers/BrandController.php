<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Imports\ExcelImport;
use App\Exports\ExcelExport;
use Excel;
use Illuminate\Support\Facades\Date;
date_default_timezone_set('Asia/Ho_Chi_Minh');

session_start();

class BrandController extends Controller
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

    public function list_brand(){
        $this->authenLogin();
        //$all_brand = DB::table('tbl_brand')->get();
        //$all_brand = Brand::orderBy('brand_id','Desc')->take(4)->get();  lấy 4 giá trị thôi
        //$all_brand = Brand::orderBy('brand_id','Desc')->paginate(4)->get();  phân trang
        $all_brand = Brand::orderBy('brand_id','Desc')->paginate(10);
        return view('admin.Brand.list_brand')->with(compact('all_brand'));
    }

    public function add_brand(Request $request){

        //Cách 1
        // $this->authenLogin();
        // $data = array();
        // $data['brand_name'] = $request->name_brand; // "brand_name" là tên cột trong database -- "name_brand" là name trong html
        // $data['brand_description'] = $request->description_brand;
        // $data['brand_status'] = $request->status_brand;
        // $data['created_at'] = new DateTime();
        // DB::table('tbl_brand')->insert($data);
        // Session::put('message', "Insert Successfully!!!");
        // return Redirect::to('/list-brand');

        $this->authenLogin();
        $this->validation($request);
        $data = $request->all();

        $brand = new Brand();
        $brand->brand_name  = $data['name_brand']; // "brand_name" là tên cột trong database -- "name_brand" là name trong html
        $brand->brand_slug  = $data['slug_brand'];
        $brand->brand_status  = $data['status_brand'];
        $brand->created_at  = now();
        $brand->save();
        Session::put('message', "Insert Successfully!!!");
        return Redirect::to('/list-brand');
    }

    public function edit_brand($param_brand_id){
        $this->authenLogin();
        //$edit_brand = DB::table('tbl_brand')->where('brand_id', $param_brand_id)->get();
        $edit_brand = Brand::where('brand_id', $param_brand_id)->get();
        $manage_brand = view('admin.Brand.update_brand')->with('update_brand', $edit_brand);
        return view('admin.admin_dashboard')->with('admin.Brand.update_brand', $manage_brand);
    }

    public function update_brand(Request $request, $param_brand_id){
        $this->authenLogin();
        $this->validation($request);
        $data = $request->all();

        $brand = Brand::find($param_brand_id);
        $brand->brand_name  = $data['name_brand']; // "brand_name" là tên cột trong database -- "name_brand" là name trong html
        $brand->brand_slug  = $data['slug_brand'];
        $brand->updated_at  = now();
        $brand->save();

        Session::put('message', "Update Successfully!!!");
        return Redirect::to('/list-brand');
    }

    public function delete_brand($param_brand_id){
        $this->authenLogin();
        Brand::find($param_brand_id)->delete();
        //DB::table('tbl_brand')->where('brand_id', $param_brand_id)->delete();
        Session::put('message', "Delete Successfully!!!");
        return Redirect::to('/list-brand');
    }

    // Thay đổi status ẩn hiện
    public function active_status_brand($param_brand_id){
        $this->authenLogin();
        $get_brand_name = Brand::where('brand_id', $param_brand_id)->select('brand_name')->first();
        Brand::where('brand_id', $param_brand_id)->update(['brand_status'=>0]);
        Session::put('message_status', "Hidden " .'"'."'$get_brand_name->brand_name'".'"');
        return Redirect::to('/list-brand');  
    }

    public function inactive_status_brand($param_brand_id){
        $this->authenLogin();
        $get_brand_name =  Brand::where('brand_id', $param_brand_id)->select('brand_name')->first();
        Brand::where('brand_id', $param_brand_id)->update(['brand_status'=>1]);
        Session::put('message_status', "Showed " .'"'."'$get_brand_name->brand_name'".'"');
        return Redirect::to('/list-brand');
    }

    public function validation($request){
        return $this->validate($request,[
           'name_brand' => ['required', 'max:100'],
        ]);
     }

    // #########################################################################################################v#######
    // ###########################################CLIENT#####################################################v##########
    public function thuong_hieu_san_pham($brand_slug){
        $all_cate = Category::where('cate_status', '1')->orderBy('cate_id', 'desc')->get();
        $all_brand = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $get_brand_name = Brand::where('tbl_brand.brand_slug', $brand_slug)->limit(1)->get();
        $banner = Banner::where('banner_status', '1')->get();
        $product_byId = Product::join('tbl_brand', 'tbl_brand.brand_id' ,'=', 'tbl_product.brand_id')
        ->where('tbl_brand.brand_slug', $brand_slug)
        ->where('product_status', '1')->limit(4)->get();

        return view('/Page.Brand.show_brand_byId')->with(compact('all_cate', 'all_brand', 'product_byId', 'get_brand_name' ,'banner'));
    }
}
