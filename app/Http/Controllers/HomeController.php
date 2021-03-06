<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Visitor;
use App\Models\Banner;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
session_start();

class HomeController extends Controller
{

    public function error_page(){
        return view('errors.404');
    }

    public function index(Request $request){

        $ip_address = $request->ip();
        $visitor_current = Visitor::where("visitor_ip", $ip_address)->get();
        $visitor_count = $visitor_current->count();
        if($visitor_count < 1){
           $visitor = new Visitor();
           $visitor->visitor_ip = $ip_address;
           $visitor->visitor_date = Carbon::now();
           $visitor->save();
        }


        $all_cate = Category::where('cate_status', '1')->orderBy('cate_id', 'desc')->get();
        $all_brand = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $banner = Banner::where('banner_status', '1')->get();
        //$all_product = Product::where('product_status', '1')->orderBy('product_id', 'desc')->paginate(8);
        $all_product = Product::join('tbl_category', 'tbl_category.cate_id','=', 'tbl_product.cate_id')
        ->join('tbl_brand', 'tbl_brand.brand_id','=', 'tbl_product.brand_id')
        ->where('product_status', '1')
        ->where('brand_status', '1')
        ->where('cate_status', '1')
        ->orderBy('product_id', 'DESC')
        ->paginate(8);
        //->orderBy(DB::raw('RAND()'))->paginate(8);
        
        
        //return view('Page.home')->with('all_cate', $cate_product)->with('all_brand', $brand_product)->with('all_product', $product); // Cách 1
        return view('Page.home')->with(compact('all_cate', 'all_brand', 'all_product', 'banner')); // Cách 2
        // Page.home là đường dẫn đến file home.blade.php
    }

    public function search_product(Request $request){
        $keyword = $request->keyword_search;
        $all_cate = Category::where('cate_status', '1')->orderBy('cate_id', 'desc')->get();
        $all_brand = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $banner = Banner::where('banner_status', '1')->get();
        $search_product = Product::where('product_status', '1')
        ->where('product_name', 'like', '%'.$keyword.'%')
        ->orderBy('product_id', 'desc')
        ->limit(8)->get();
        return view('/Page.Product.search_product')->with(compact('all_cate', 'all_brand', 'search_product', 'banner'));
    }

    public function autocomplete_search(Request $request){
        $data = $request->all();
        $query = $data['query'];
        if($query){
            $product = Product::where('product_status', 1)->where('product_name', 'LIKE', '%'.$query.'%')->get();
            $output = '<ul class="dropdown-menu" style="display: block; position:relative">';
            foreach($product as $key => $value){
                $output .= '
                <li id="li_search_ajax"><a href="#">'.$value->product_name.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    // Sẽ có ngày cần
    public function send_mail(){
        $to_name = "Laravel_Sunday";
        $to_email = "sunday03082014@gmail.com";//send to this email
        
        $data = array("name"=>"Mail từ khách hàng","body"=>'Support',"end"=>"Thanks"); //body of mail.blade.php
            
        Mail::send('page.send_mail',$data,function($message) use ($to_name,$to_email){
        $message->to($to_email)->subject('test mail nhé');//send this mail with subject
        $message->from($to_email,$to_name);//send from this mail
        });
    }

    public function test(){
        return view('test');
    }

    public function contact(){
        $all_cate = Category::where('cate_status', '1')->orderBy('cate_id', 'desc')->get();
        $all_brand = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        return view('/Page.contact')->with(compact('all_cate', 'all_brand')); // Cách 2
    }
}