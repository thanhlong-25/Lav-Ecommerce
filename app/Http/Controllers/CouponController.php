<?php

namespace App\Http\Controllers;
use DateTime;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
date_default_timezone_set('Asia/Ho_Chi_Minh');

class CouponController extends Controller
{

    public function authenLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
           return Redirect::to('/dashboard');
        }else{
           return Redirect::to('/admin')->send();
        }
    }
    public function add_coupon(Request $request){
        $this->authenLogin();
        $this->validation($request);
        $data = $request->all();

        $coupon = new Coupon();
        $coupon->coupon_name  = $data['name_coupon']; // "coupon_name" là tên cột trong database -- "name_coupon" là name trong html
        $coupon->coupon_code  = $data['code_coupon'];
        $coupon->coupon_qty  = $data['qty_coupon'];
        $coupon->coupon_mode  = $data['mode_coupon'];
        $coupon->coupon_value  = $data['value_coupon'];
        $coupon->max_promote_value = $data['max_promote_coupon'];
        $coupon->created_at  = now();
        $coupon->save();
        Session::put('message', "Insert Successfully!!!");
        return Redirect::to('/list-coupon');  
    }

    public function list_coupon(){
        $this->authenLogin();
        $all_coupon = Coupon::orderBy('coupon_id','Desc')->paginate(10);
        $manage_coupon = view('admin.Coupon.list_coupon')->with('all_coupon', $all_coupon);
        return view('admin.admin_dashboard')->with('admin.Coupon.list_coupon', $manage_coupon);
    }

    public function edit_coupon($param_coupon_id){
        $this->authenLogin();
        $edit_coupon = Coupon::where('coupon_id', $param_coupon_id)->get();
        $manage_coupon = view('admin.Coupon.update_coupon')->with('update_coupon', $edit_coupon);
        return view('admin.admin_dashboard')->with('admin.Coupon.update_coupon', $manage_coupon);
    }

    public function update_coupon(Request $request, $param_coupon_id){
        $this->authenLogin();
        $this->validation($request);
        $data = $request->all();

        $coupon = coupon::find($param_coupon_id);
        $coupon->coupon_name  = $data['name_coupon']; // "coupon_name" là tên cột trong database -- "name_coupon" là name trong html
        $coupon->coupon_code  = $data['code_coupon'];
        $coupon->coupon_qty  = $data['qty_coupon'];
        $coupon->coupon_mode  = $data['mode_coupon'];
        $coupon->coupon_value  = $data['value_coupon'];
        $coupon->max_promote_value = $data['max_promote_coupon'];
        $coupon->updated_at  = now();
        $coupon->save();

        Session::put('message', "Update Successfully!!!");
        return Redirect::to('/list-coupon');
    }

    public function delete_coupon($param_coupon_id){
        $this->authenLogin();
        coupon::find($param_coupon_id)->delete();
        Session::put('message', "Delete Successfully!!!");
        return Redirect::to('/list-coupon');
    }


    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon_check'])->first();
        if($coupon && $coupon->coupon_qty > 0){
            $count_coupon =  $coupon->count();
                if($count_coupon > 0){
                    $coupon_session = Session::get('coupon');
                    if($coupon_session == true){
                        $is_available = 0;
                        if($is_available == 0){
                            $count[] = array(
                                'coupon_id'=> $coupon->coupon_id,
                                'coupon_code' => $coupon->coupon_code,
                                'coupon_qty' => $coupon->coupon_qty,
                                'coupon_value' => $coupon->coupon_value,
                                'max_promote_value' => $coupon->max_promote_value,
                                'coupon_mode' => $coupon->coupon_mode,
                            );
                            Session::put('coupon', $count);
                        }
                    }else{
                            $count[] = array(
                                'coupon_id'=> $coupon->coupon_id,
                                'coupon_code' => $coupon->coupon_code,
                                'coupon_qty' => $coupon->coupon_qty,
                                'coupon_value' => $coupon->coupon_value,
                                'max_promote_value' => $coupon->max_promote_value,
                                'coupon_mode' => $coupon->coupon_mode,
                            );
                            Session::put('coupon', $count);
                    }
                    Session::save();
                    return  Redirect::to('/show-cart-ajax')->with('message', "Thêm mã giảm giá thành công");
                }
        }else if($coupon == true && $coupon->coupon_qty <= 0){
            return Redirect::to('/show-cart-ajax')->with('error', "Số lượng mã giảm giá này đã hết");
        }else{
            return Redirect::to('/show-cart-ajax')->with('error', "Mã giảm giá không tồn tại");
        }
    }

    public function validation($request){
        return $this->validate($request,[
            'name_coupon' => ['required', 'max:255'],
            'code_coupon' => ['required', 'max:15', 'unique'],
            'qty_coupon' => ['required', 'max:255'],
            'max_promote_coupon' => ['required', 'max:255'],
            'value_coupon' => ['required', 'max:255'],   
        ]);
    }
}