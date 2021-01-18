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
use App\Models\Rating;
use File;
use DateTime;
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();

class ProductController extends Controller
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

    public function list_product(){
        $this->authenLogin();
        $all_cate = Category::orderBy('cate_id', 'desc')->get();
        $all_brand = Brand::orderBy('brand_id', 'desc')->get();
        $all_product = Product::join('tbl_category', 'tbl_category.cate_id','=', 'tbl_product.cate_id')
            ->join('tbl_brand', 'tbl_brand.brand_id','=', 'tbl_product.brand_id')
            ->orderByDesc('tbl_product.product_id')->paginate(10);
     
        return view('admin..Product.list_product')->with(compact('all_product', 'all_brand', 'all_cate'));
    }

    public function add_product(Request $request){
        $this->authenLogin();
        $this->validation($request);
        $data = $request->all();

        $path_product = 'public/upload/products/';
        $path_gallery = 'public/upload/gallerys/';

        $product = new Product();
        $product->product_name  = $data['name_product']; // "brand_name" là tên cột trong database -- "name_brand" là name trong html
        $product->product_slug  = $data['slug_product'];
        $product->cate_id  = $data['cate_id_product'];
        $product->brand_id  = $data['brand_id_product'];
        $product->product_inventory  = $data['inventory_product'];
        $product->product_price  = $data['price_product'];
        $product->product_slug  = $data['slug_product'];;
        $product->product_status  = $data['status_product'];
        $product->product_description  = $data['description_product'];
        $data['created_at'] = new DateTime();
        $get_image = $request->file('image_product');     

        if($get_image){
            $today = Carbon::today();  
            $month = $today->monthName;      
            $day = $today->day;

            $get_name_image = $get_image->getClientOriginalName(); //Get name của image tải lên
            $name_image = current(explode('.', $get_name_image)); // tách chuỗi theo dấu chấm nếu không file ảnh sẽ là Gallery.jpg.12.png là ăn
            //$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $new_image = $name_image.'-'.$month.'-'.$day. '-' .mt_rand(). '.' .$get_image->getClientOriginalExtension(); // tên ảnh cuối cùng
            $get_image->move($path_product, $new_image);
            File::copy($path_product.$new_image, $path_gallery.$new_image); // Form, TO. Sau khi thêm vào product thì copy đưa qua  gallerys

            $product->product_image  = $new_image;
            $product->save();

            $get_product_id = $product->product_id; // Sau khi insert xong thi getId ra để xíu có cái đặng query đặng thêm vào Gallery
            $gallery = new Gallery();
            $gallery->gallery_image = $new_image;
            $gallery->product_id = $get_product_id;
            $gallery->save();

            Session::put('message', "Insert Successfully!!!");
            return Redirect::to('/list-product');
        }else{
            $product->product_image  ="";
            $product->save();
            Session::put('message', "Something went wrong!!!");
            return Redirect::to('/add-product');
        }
    }

    public function edit_product($param_product_id){
        $this->authenLogin();
        $edit_product = Product::where('product_id', $param_product_id)->get();
        $cate_product = Category::orderBy('cate_id', 'desc')->get();
        $brand_product = Brand::orderBy('brand_id', 'desc')->get();
        //$manage_product = view('admin.update_product')->with('all_cate', $cate_product)->with('all_brand', $brand_product);

        $manage_product = view('admin.Product.update_product')->with('update_product', $edit_product)->with('all_cate', $cate_product)->with('all_brand', $brand_product);
        return view('admin.admin_dashboard')->with('admin.Product.update_product', $manage_product);
    }

    public function update_product(Request $request, $param_product_id){
        $this->authenLogin();
        $this->validation($request);
        $data = $request->all();

        $product = Product::find($param_product_id);
        $product->product_name  = $data['name_product']; // "brand_name" là tên cột trong database -- "name_brand" là name trong html
        $product->cate_id  = $data['cate_id_product'];
        $product->brand_id  = $data['brand_id_product'];
        $product->product_inventory  = $data['inventory_product'];
        $product->product_slug  = $data['slug_product'];
        $product->product_price  = $data['price_product'];
        $product->product_description  = $data['description_product'];
        $data['updated_at'] = new DateTime();
        $get_image = $request->file('image_product');     

        if($get_image){
            $today = Carbon::today();  
            $month = $today->month;      
            $day = $today->day;

            $get_name_image = $get_image->getClientOriginalName(); //Get name của image tải lên
            $name_image = current(explode('.', $get_name_image)); // tách chuỗi theo dấu chấm nếu không file ảnh sẽ là Gallery.jpg.12.png là ăn
            //$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $new_image = $name_image.'-'.$month.'-'.$day.'-'.mt_rand().'.'.$get_image->getClientOriginalExtension(); // tên ảnh cuối cùng
            $get_image->move('public/upload/products', $new_image);

            $product->product_image  = $new_image;
            $product->save();
            Session::put('message', "Update Successfully!!!");
            return Redirect::to('/list-product');
        }else{
            $product->save();
            Session::put('message', "Update Successfully nhưng mà kh thay đổi ảnh !!!");
            return Redirect::to('/list-product');
        }
    }

    public function delete_product($param_product_id){
        $this->authenLogin();
        $product = Product::find($param_product_id);
        $product_image = $product->product_image;
        unlink('public/upload/products/'.$product_image);
        $product->delete();
        Session::put('message', "Delete Successfully!!!");
        return redirect()->back();
    }

    // Thay đổi status ẩn hiện
    public function active_status_product($param_product_id){
        $this->authenLogin();
        $get_product_name = Product::select('product_name')->where('tbl_product.product_id', $param_product_id)->first();
        //$get_brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id', $brand_id)->limit(1)->get();
        Product::where('product_id', $param_product_id)->update(['product_status'=>0]);
        Session::put('message_status', "Hidden " .'"'."'$get_product_name->product_name'".'"' );
        return Redirect::to('/list-product');  
    }

    public function inactive_status_product($param_product_id){
        $this->authenLogin();
        $get_product_name = Product::select('product_name')->where('tbl_product.product_id', $param_product_id)->first();
        Product::where('product_id', $param_product_id)->update(['product_status'=>1]);
        Session::put('message_status', "Showed " .'"'."'$get_product_name->product_name'".'"' );
        return Redirect::to('/list-product');
    }

    public function validation($request){
        return $this->validate($request,[
           'name_product' => ['required', 'max:100'],
           'description_product' => ['required', 'max:255'],
           'inventory_product' => ['required', 'max:10'],
           'price_product' => ['required', 'max:100'],
        ]);
     }


    // #########################################################################################################v#######
    // ###########################################CLIENT#####################################################v##########

    public function chi_tiet_san_pham($product_slug){
        $cate_product = Category::where('cate_status', '1')->orderBy('cate_id', 'desc')->get();
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $banner = Banner::where('banner_status', '1')->get();
        $detail_product = Product::join('tbl_category', 'tbl_category.cate_id','=', 'tbl_product.cate_id')
        ->join('tbl_brand', 'tbl_brand.brand_id','=', 'tbl_product.brand_id')
        ->where('tbl_product.product_status', '1')
        ->where('tbl_product.product_slug', $product_slug)->get();


        // lấy những liên quan --start
        foreach($detail_product as $key => $product_recommended){
            $product_id = $product_recommended->product_id;
            $product_cate = $product_recommended->cate_name;
            $cate_id_relative = $product_recommended->cate_id;
        }

        $gallery = Gallery::where('product_id', $product_id)->limit(4)->get();
        $rating = Rating::where('product_id', $product_id)->avg('rating_value');
        $rating = round($rating);

        $relative_product = Product::join('tbl_category', 'tbl_category.cate_id','=', 'tbl_product.cate_id')
        ->join('tbl_brand', 'tbl_brand.brand_id','=', 'tbl_product.brand_id')
        ->where('tbl_product.product_status', '1')
        ->whereNotIn('tbl_product.product_slug', [$product_slug]) // không lấy item hiện tại
        ->where('tbl_category.cate_id', $cate_id_relative)->get();
        // lấy những sản phẩm thuộc danh mục --end

        return view('Page.Product.detail_product')
        ->with('all_cate', $cate_product)
        ->with('all_brand', $brand_product)
        ->with('detail_product', $detail_product)
        ->with('product_recommended', $relative_product)
        ->with('product_cate', $product_cate )
        ->with('banner', $banner)
        ->with('all_gallery', $gallery)
        ->with('rating', $rating);
    }

    public function rating_product(Request $request){
        $data = $request->all();
        $product_id = $data['product_id'];
        $customer_id =  $data['customer_id'];
        $rating_value =  $data['index'];

        $check = Rating::where('customer_id', $customer_id)->where('product_id', $product_id)->get();
        if($check->isEmpty()){
            $rate = new Rating();
            $rate->product_id = $product_id;
            $rate->customer_id = $customer_id;
            $rate->rating_value = $rating_value;
            $rate->save();
        }else{
            Rating::where('customer_id', $customer_id)->where('product_id', $product_id)->update(['rating_value' => $rating_value]);
        }
        
    }

}
