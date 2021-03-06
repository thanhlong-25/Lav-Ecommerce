<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
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
        $all_category = Category::orderBy('cate_id','Desc')->paginate(20);
        return view('admin.Category.list_category')->with(compact('all_category'));
    }

    public function add_category(Request $request){
        $this->authenLogin();
        $this->validation($request);
        $data = $request->all();

        $category = new Category();
        $category->cate_name  = $data['name_category']; // "brand_name" là tên cột trong database -- "name_brand" là name trong html
        $category->cate_slug  = $data['slug_category'];
        $category->cate_status  = $data['status_category'];
        $category->created_at  = new DateTime();
        $category->save();
        Session::put('message', "Insert Successfully!!!");
        return Redirect::to('/list-category');
    }

    public function edit_category($param_cate_id){
        $this->authenLogin();
        $edit_category = Category::where('cate_id', $param_cate_id)->get();
        return view('admin.Category.update_category')->with('update_category', $edit_category);
    }

    public function update_category(Request $request, $param_cate_id){
        $this->authenLogin();
        $this->validation($request);
        $data = $request->all();

        $cate = Category::find($param_cate_id);
        $cate->cate_name  = $data['name_category']; // "brand_name" là tên cột trong database -- "name_brand" là name trong html
        $cate->cate_slug  = $data['slug_category'];
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

    public function inactive_status_cate($param_cate_id){
        $this->authenLogin();
        $get_category_name = Category::where('cate_id', $param_cate_id)->select('cate_name')->first();
        Category::where('cate_id', $param_cate_id)->update(['cate_status'=>1]);
        Session::put('message_status', "Showed " .'"'."'$get_category_name->cate_name'".'"');
        return Redirect::to('/list-category');
    }

    public function validation($request){
        return $this->validate($request, [
            'name_category' => ['required', 'max:100'],
        ]);
    }

    // #########################################################################################################v#######
    // ###########################################CLIENT#####################################################v##########
    public function danh_muc_san_pham($cate_slug){
        //$get_category_by_id = DB::table('tbl_category')->where('cate_id', $cate_id)->get();
        $all_cate = Category::where('cate_status', '1')->orderBy('cate_id', 'desc')->get();
        $all_brand = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $get_cate_name = Category::where('tbl_category.cate_slug', $cate_slug)->select('cate_name')->first();
        $get_cate_id = Category::where('tbl_category.cate_slug', $cate_slug)->select('cate_id')->first();
        $product_byId = Product::join('tbl_category', 'tbl_category.cate_id' ,'=', 'tbl_product.cate_id')
        ->where('tbl_category.cate_slug', $cate_slug)
        ->where('product_status', '1')->paginate(8);
        
        if(isset($_GET['sap_xep'])){
            $sort_by = $_GET['sap_xep'];

            if($sort_by == 'ten_tang_dan'){ 
                $product_byId = Product::with('category')->where('cate_id', $get_cate_id->cate_id)->where('product_status', '1')->orderBy('product_name', 'ASC')->paginate(8)->appends(request()->query());
            }else if($sort_by == 'ten_giam_dan'){
                $product_byId = Product::with('category')->where('cate_id', $get_cate_id->cate_id)->where('product_status', '1')->orderBy('product_name', 'DESC')->paginate(8)->appends(request()->query());
            }else if($sort_by == 'gia_tang_dan'){
                $product_byId = Product::with('category')->where('cate_id', $get_cate_id->cate_id)->where('product_status', '1')->orderBy('product_price', 'ASC')->paginate(8)->appends(request()->query());
            }else if($sort_by == 'gia_giam_dan'){
                $product_byId = Product::with('category')->where('cate_id', $get_cate_id->cate_id)->where('product_status', '1')->orderBy('product_price', 'DESC')->paginate(8)->appends(request()->query());
            }else{
            }
    }
    return view('/Page.Category.show_category_byId')->with(compact('all_cate', 'all_brand', 'product_byId', 'get_cate_name'));
}

}