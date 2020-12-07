<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Banner;
use DateTime;
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();

class CategoryController extends Controller
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

    public function list_category(){
        $this->authenLogin();
        $all_category = Category::orderBy('cate_id','Desc')->paginate(10);
        return view('admin.Category.list_category')->with(compact('all_category'));
    }

    public function add_category(Request $request){
        $this->authenLogin();
        $data = $request->all();

        $category = new Category();
        $category->cate_name  = $data['name_category']; // "brand_name" là tên cột trong database -- "name_brand" là name trong html
        $category->cate_description  = $data['description_category'];
        $category->cate_status  = $data['status_category'];
        $category->created_at  = new DateTime();
        $category->save();
        Session::put('message', "Insert Successfully!!!");
        return Redirect::to('/list-category');
    }

    public function edit_category($param_cate_id){
        $this->authenLogin();
        $edit_category = Category::where('cate_id', $param_cate_id)->get();
        $manage_category = view('admin.Category.update_category')->with('update_category', $edit_category);
        return view('admin.admin_dashboard')->with('admin.Category.update_category', $manage_category);
    }

    public function update_category(Request $request, $param_cate_id){
        $this->authenLogin();
        $data = $request->all();

        $cate = Category::find($param_cate_id);
        $cate->cate_name  = $data['name_category']; // "brand_name" là tên cột trong database -- "name_brand" là name trong html
        $cate->cate_description  = $data['description_category'];
        $cate->updated_at  = new DateTime();
        $cate->save();

        Session::put('message', "Update Successfully!!!");
        return Redirect::to('/list-category');
    }

    public function delete_category($param_cate_id){
        $this->authenLogin();
        Category::find($param_cate_id)->delete();
        Session::put('message', "Delete Successfully!!!");
        return Redirect::to('/list-category');
    }

    // Thay đổi status ẩn hiện
    public function active_status_cate($param_cate_id){
        $this->authenLogin();
        $get_category_name = Category::where('cate_id', $param_cate_id)->select('cate_name')->first();
        Category::where('cate_id', $param_cate_id)->update(['cate_status'=>0]);
        Session::put('message_status', "Hidden " .'"'."'$get_category_name->cate_name'".'"');
        return Redirect::to('/list-category');  
    }

    public function unactive_status_cate($param_cate_id){
        $this->authenLogin();
        $get_category_name = Category::where('cate_id', $param_cate_id)->select('cate_name')->first();
        Category::where('cate_id', $param_cate_id)->update(['cate_status'=>1]);
        Session::put('message_status', "Showed " .'"'."'$get_category_name->cate_name'".'"');
        return Redirect::to('/list-category');
    }

    // #########################################################################################################v#######
    // ###########################################CLIENT#####################################################v##########
    public function danh_muc_san_pham($cate_id){
        //$get_category_by_id = DB::table('tbl_category')->where('cate_id', $cate_id)->get();
        $all_cate = Category::where('cate_status', '1')->orderBy('cate_id', 'desc')->get();
        $all_brand = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $banner = Banner::where('banner_status', '1')->get();
        $product_byId = Product::join('tbl_category', 'tbl_category.cate_id' ,'=', 'tbl_product.cate_id')
        ->where('tbl_product.cate_id', $cate_id)
        ->where('product_status', '1')->limit(4)->get();
        $get_cate_name = Category::where('tbl_category.cate_id', $cate_id)->limit(1)->get();

        return view('/Page.Category.show_category_byId')->with(compact('all_cate', 'all_brand', 'product_byId', 'get_cate_name' ,'banner'));
    }

}
