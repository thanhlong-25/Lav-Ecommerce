<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\City_Province;
use App\Models\District;
use App\Models\SubDistrict;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Order;
use Nexmo\Laravel\Facade\Nexmo;
use App\Models\Order_details;
use App\Models\UserCustomer;
use App\Models\Statistics;
use Illuminate\Support\Facades\Mail;
use DateTime;
use PDF;
date_default_timezone_set('Asia/Ho_Chi_Minh');
use Cart;
session_start();

class CheckoutController extends Controller
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

    public function manage_order(){
        $this->authenLogin();
        $all_order = Order::join('tbl_usercustomer', 'tbl_usercustomer.customer_id','=', 'tbl_order.customer_id')
            ->join('tbl_shipping', 'tbl_shipping.order_id','=', 'tbl_order.order_id')->orderBy('order_id', 'desc')->get();
        return view('admin.Order.manage_order')->with('all_order');
    }

    public function view_order($order_id){
        $this->authenLogin();
        $order = Order::join('tbl_usercustomer', 'tbl_usercustomer.customer_id','=', 'tbl_order.customer_id')
        ->join('tbl_shipping', 'tbl_shipping.order_id','=', 'tbl_order.order_id')
        ->join('tbl_order_details', 'tbl_order_details.order_id','=', 'tbl_order.order_id')
        ->where('tbl_order.order_id', $order_id)->get();

        $order_detail = Order_details::join('tbl_product', 'tbl_product.product_id' ,'=', 'tbl_order_details.product_id')
        ->where('tbl_order_details.order_id', $order_id)->get();
        return view('admin.Order.view_order')->with(compact('order','order_detail'));
    }

    public function list_order(){
        $this->authenLogin();
        $all_order = Order::join('tbl_usercustomer', 'tbl_usercustomer.customer_id','=', 'tbl_order.customer_id')
        ->join('tbl_shipping', 'tbl_shipping.order_id','=', 'tbl_order.order_id')->orderBy('tbl_order.created_at', 'desc')->paginate(10);
        return view('admin.Order.list_order')->with(compact('all_order'));
    }

    public function update_order_status(Request $request){
        $this->authenLogin();

        $now = Carbon::now()->toDateString();
        $data = $request->all();
        $order_quantity = $data['order_quantity'];
        $product_id = $data['product_id'];
        $order_id = $data['order_id'];
        $coupon_code = $data['coupon_code'];
        $status = $data['status'];
        $get_statistic = Statistics::where('stat_date', $now)->get();
        
        if($status == "Đã giao"){
            Order::where('order_id', $order_id)->update(['order_finishdate' => $now]);

            //update thống kê
            $total_sale = 1;
            $total_profit = 0;
            $total_quantity = 0;

            // update tồn kho trong product
            foreach($product_id as $key => $id_value){
                $product = Product::find($id_value);
                $product_inventory = $product->product_inventory;
                $product_price = $product->product_price;
                $product_sold = $product->product_sold;
                foreach($order_quantity as $key2 => $quantity){
                    if($key == $key2){
                            $product_remain = $product_inventory - $quantity;
                            $product->product_inventory =  $product_remain;
                            $product->product_sold = $product_sold + $quantity;

                            //update thống kê
                            $total_sale += $quantity*$product_price - $coupon_code;
                            $total_profit += ($total_sale * 15)/100 ;
                            $total_quantity += $quantity;
                    }
                }
                $product->save();
            }
            $count_statistic = $get_statistic->count();
                if($count_statistic > 0){
                    $update_statistic = Statistics::where('stat_date', $now)->first();
                    $update_statistic->stat_sales = $update_statistic->stat_sales + $total_sale;
                    $update_statistic->stat_profits = $update_statistic->stat_profits + $total_profit;
                    $update_statistic->total_quantities = $update_statistic->total_quantities + $total_quantity;
                    $update_statistic->total_orders = $update_statistic->total_orders + 1;
                    $update_statistic->save();
                }else{
                    $new_statistic = new Statistics();
                    $new_statistic->stat_date =  $now;
                    $new_statistic->stat_sales =  $total_sale;
                    $new_statistic->stat_profits =  $total_profit;
                    $new_statistic->total_quantities =  $total_quantity;
                    $new_statistic->total_orders =  1;
                    $new_statistic->save();
        }
        }

        
        Order::where('order_id', $order_id)->update(['order_status' => $status]);
    }

    public function print_order($checkout_code){
            $this->authenLogin();
            $pdf = \App::make('dompdf.wrapper');
            $pdf -> loadHTML($this->print_order_convert($checkout_code));
            return $pdf->stream();
    }

    public function print_order_convert($checkout_code){
        $this->authenLogin();
        $order = Order::join('tbl_usercustomer', 'tbl_usercustomer.customer_id','=', 'tbl_order.customer_id')
        ->join('tbl_shipping', 'tbl_shipping.order_id','=', 'tbl_order.order_id')
        ->join('tbl_order_details', 'tbl_order_details.order_id','=', 'tbl_order.order_id')
        ->where('tbl_order.order_id', $checkout_code)->get();

        $order_detail = Order_details::join('tbl_product', 'tbl_product.product_id' ,'=', 'tbl_order_details.product_id')
        ->where('tbl_order_details.order_id', $checkout_code)->get();

        $total = 0;
        $subtotal = 0;
        $output = '<style>
                body{
                    font-family: DejaVu Sans;
                    }
                .table-styling{
                    border: 1px solid #000;
                    width: 700px;
                    margin: 15px;
                }
                .table-styling tbody tr td{
                    border: 1px solid #000;
                    text-align: center;
                }
                .table-styling thead tr th{
                    border: 1px solid #000;
                }    
                </style>';
        
        $output .= '
        <p>Thông tin người gửi</p>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Cá nhân/Tổ chức</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Công ty Trần Thành Long</td> 
                    <td>Bùi Quang Là, Phường 12, Quận Gò Vấp, Hồ Chí Minh</td>
                    <td>0981803365</td>
                </tr>
            }
            </tbody>    
        </table>

        <p>Thông tin người nhận</p>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Họ tên</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Lưu ý</th>
                </tr>
            </thead>
            <tbody>
            ';
            foreach($order as $key => $order_value){}
                $output.='
                <tr>
                    <td>'.$order_value->shipping_name.'</td> 
                    <td>'.$order_value->shipping_address.'</td>
                    <td>'.$order_value->shipping_phone.'</td>
                    <td>'.$order_value->shipping_note.'</td>
                </tr>
                ';
            $output.='
            </tbody>    
        </table>

        <p>Đơn hàng</p>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                </tr>
            </thead>
            <tbody>
            ';
            foreach($order_detail as $key => $order_detail_value){
                $subtotal = $order_detail_value->product_price * $order_detail_value->product_sales_quantity;
                $output.='
                <tr>
                    <td>'.$order_detail_value->product_name.'</td> 
                    <td>'.number_format($order_detail_value->product_price,0,',','.').'</td>
                    <td>'.$order_detail_value->product_sales_quantity.'</td>
                </tr>
                ';
                $total+=$subtotal;
            }
            $output.='
            </tbody>    
        </table>

        <p>Thanh toán</p>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Đơn hàng</th>
                    <th>Khuyến mãi</th>
                    <th>Phí ship</th>
                    <th>Tổng thanh toán</th>
                </tr>
            </thead>
            <tbody>
            ';
                $output.='
                <tr>
                    <td>'.number_format($total,0,',','.').'đ</td>
                    <td>'.number_format($order_value->coupon_code,0,',','.').'đ</td>
                    <td>30.000đ</td>
                    <td>'.number_format($total - $order_value->coupon_code + 30000,0,',','.').'đ</td>
                </tr>
                ';
            $output.='
            </tbody>    
        </table>
        <p>Ngày xuất đơn: '.now().'</p>
        
      ';
        return $output;
    }


    // #########################################################################################################v#######
    // ###########################################CLIENT#####################################################v##########

    public function login_checkout(){
        $all_cate = Category::where('cate_status', '1')->orderBy('cate_id', 'desc')->get();
        $all_brand = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();

        return view('/Page.Checkout.login_checkout')->with(compact('all_cate','all_brand'));
    }

    public function logout_checkout(){
        //Session::put('customer_id', null);
        Session::flush();
        return Redirect::to('/');
    }

    public function login_customer(Request $request){
        $customer_email = $request->email_login;
        $customer_password = md5($request->password_login);
        $result = UserCustomer::where('customer_email', $customer_email)->where('customer_password', $customer_password)->first(); // First() là lấy 1 value

        if($result){
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/trang-chu');
        }else{
            return Redirect::to('/login-checkout');
        }
        
    }


    public function register_customer(Request $request){
        $data = $request->all();
        $customer = new UserCustomer();
        $customer->customer_name = $data['name_register'];
        $customer->customer_email = $data['email_register'];
        $customer->customer_phone = $data['phone_register'];
        $customer->customer_password = md5($data['password_register']);
        $customer->created_at = new DateTime();
        $customer_repassword = $data['repassword_register'];

        if($data['password_register'] == $customer_repassword){
            $customer->save();
            Session::put('customer_name', $data['name_register']);
            return Redirect::to('/login-checkout');
        }else{
            return Redirect::to('/login-checkout');
        }
        
    }

    public function send_orther(Request $request){
        $coupon = Session::get('coupon'); 
        if($coupon){
            foreach($coupon as $sessioncoupon => $value){}
        }
        $cart = Session::get('cart'); 
        $city = $request->city_province; 
        $district = $request->district;
        $subdistrict = $request->subdistrict;
        $city_name = City_Province::where('city_id', $city)->select('city_name')->first();;
        $district_name = District::where('district_id', $district)->select('district_name')->first();;
        $subdistrict_name = SubDistrict::where('subdistrict_id', $subdistrict)->select('subdistrict_name')->first();;

        //insert order
        $data_orther = array();
        $data_orther['customer_id'] = Session::get('customer_id'); // khi đăng nhập thì ta sẽ có customer ID, thì lấy thôi
        $data_orther['payment_method'] = $request->payment_option; //
        $data_orther['coupon_code'] =  $request->total_promote;                         // $coupon[$sessioncoupon]['coupon_code'];
        $data_orther['created_at'] = now();
        $data_orther['order_total'] = $request->total;
        $data_orther['order_status'] = "Chờ xử lí";
        $get_order_id = DB::table('tbl_order')->insertGetId($data_orther); // insertGetID nghĩa là khi insert xong sẽ getID luôn, để làm một số thứ

        // insert shipping
        $data_shipping = array();
        $data_shipping['order_id'] = $get_order_id;
        $data_shipping['shipping_name'] = $request->shipping_name;
        $data_shipping['shipping_email'] = $request->shipping_email;
        $data_shipping['shipping_phone'] = $request->shipping_phone;
        $data_shipping['shipping_address'] = $subdistrict_name->subdistrict_name .", " .$district_name->district_name .", " .$city_name->city_name;
        $data_shipping['shipping_note'] = $request->shipping_note;
        $data_shipping['created_at'] = now();
        DB::table('tbl_shipping')->insert($data_shipping);

       //insert order
       //$content = Cart::content();
       foreach($cart as $session => $value){
        $data_orther_details = array();
        $data_orther_details['order_id'] = $get_order_id;
        $data_orther_details['product_id'] = $cart[$session]['product_id'];
        $data_orther_details['product_sales_quantity'] = $cart[$session]['product_qty'];
        $data_orther_details['created_at'] = now();

        DB::table('tbl_order_details')->insert($data_orther_details);
       }

       if($data_orther['payment_method'] == "pay_by_ATM"){
            return redirect()->back()->with('message', "Cảm ơn bạn đã đặt hàng, chúng tôi sẽ liên lạc với bạn sớm nhất có thể!");  
       }else if($data_orther['payment_method'] == "pay_by_cash"){
            if($coupon){
                foreach(Session::get('coupon') as $key => $value){
                $id = $value['coupon_id'];
                $qty = $value['coupon_qty'];
                Coupon::where('coupon_id', $id)->update(['coupon_qty' => $qty - 1]);
                }
            }
            Session::forget('coupon');
            Session::forget('cart');
            Session::put('payment_method', $request->payment_option);
            return redirect()->back()->with('message', "Cảm ơn bạn đã đặt hàng, chúng tôi sẽ liên lạc với bạn sớm nhất có thể!");
       }
    }

    public function forgot_password(){
        $all_cate = Category::where('cate_status', '1')->orderBy('cate_id', 'desc')->get();
        $all_brand = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        return view('Page.Checkout.forgot_password')->with(compact('all_cate', 'all_brand'));
    }

    public function recover_password(Request $request){
        $phone_number = $request->phonenumber_recover_password;
        $check_phonenumber = UserCustomer::where('customer_phone', $phone_number)->get();
        
        if($check_phonenumber->count() <= 0){
            return redirect()->back()->with('error', "Không tìm thấy số điện thoại này!");
        }else{  
            $token = Str::random(8);
            $customer = UserCustomer::find($check_phonenumber[0]->customer_id);
            $customer->token_recover_password = $token;
            $customer->save();

            return Nexmo::message()->send([
                'to'   => $phone_number,
                'from' => '+84981803365',
                'text' => "{$token} is your identity code."
            ]);


            return redirect()->back()->with('message', "Vui lòng kiểm tra hộp thư đến để khôi phục mật khẩu!");
        }
        
    }
}
