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
use App\Models\City_Province;
use App\Models\District;
use App\Models\SubDistrict;
use Illuminate\Support\Carbon;
date_default_timezone_set('Asia/Ho_Chi_Minh');
use Cart;
session_start();

class CartController extends Controller
{
    public function delete_cart($session_id){
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $key => $value){
                if($value['session_id'] == $session_id){
                    $product_name = $value['product_name'];
                    unset($cart[$key]);
                    Session::forget('coupon');
                    // Nếu $value['session_id] mà bằng $session_id mình gửi qua, thì nó sẽ unset cái key trong foreach VD: unset($cart[2]);
                }
            }
            Session::put('cart', $cart); // đặt lại giá trị VD: từ 6 xuống 5 sản phẩm
            return redirect()->back()->with('message', "Xoá sản phẩm " .$product_name. " thành công!");
        }else{
            return redirect()->back()->with('error', "Xoá sản phẩm thất bại!");
        }

        // rowId là biến tự sinh trong framework
        $cate_product =  Category::where('cate_status', '1')->orderBy('cate_id', 'desc')->get();
        $brand_product =  Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        return Redirect::to('/show-cart');
    }

    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true){
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $value){
                    if($value['session_id'] == $key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', "Cập nhật giỏ hàng thành công!");
        }else{
            return redirect()->back()->with('error', "Cập nhật giỏ hàng thất bại!");
        }
    }


    // AJAX /////////////////////////////////////////////////////////////////////////////////////
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),10);
        $cart = Session::get('cart');
        if($cart == true){
            $is_avaiable = 0;
            foreach($cart as $key => $cart_value){
                if($cart_value['product_id'] == $data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_id' => $data['cart_product_id'],
                    'product_name' => $data['cart_product_name'],
                    'product_price' => $data['cart_product_price'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                );
                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_price' => $data['cart_product_price'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
            );
                Session::put('cart', $cart);
        }
        Session::save();
    }

    public function show_cart_ajax(){
        $all_cate = Category::where('cate_status', '1')->orderBy('cate_id', 'desc')->get();
        $all_brand =  Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $banner = Banner::where('banner_status', '1')->get();
        $city = City_Province::orderby('city_id', 'ASC')->get();
        $district = District::orderby('district_id', 'ASC')->get();
        $sub_district = SubDistrict::orderby('subdistrict_id', 'ASC')->get();

        return view('/Page.Cart.list_cart_ajax')->with(compact('all_cate', 'all_brand', 'city', 'district', 'sub_district', 'banner'));;
    }
}
