<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\City_Province;
use App\Models\District;
use App\Models\SubDistrict;
use App\Models\ShippingCost;
use DateTime;
date_default_timezone_set('Asia/Ho_Chi_Minh');
use Cart;
session_start();

class DeliveryAddressController extends Controller
{

    public function authenLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
           return Redirect::to('/dashboard');
        }else{
           return Redirect::to('/admin')->send();
        }
    }

    public function delivery_address(Request $request){
        $this->authenLogin();
        $city = City_Province::orderby('city_id', 'ASC')->get();
        $district = District::orderby('district_id', 'ASC')->get();
        $sub_district = SubDistrict::orderby('subdistrict_id', 'ASC')->get();
        $cost = ShippingCost::orderby('shippingcost_id', 'DESC')->get();
        return view('/admin.DeliveryAddress.delivery_address')->with(compact('city', 'district', 'sub_district', 'cost'));
    }

    public function select_delivery(Request $request){
        $this->authenLogin();
        $data = $request->all();
        if($data['action']){
            $output = "";
            if($data['action'] == "city_province_id"){
                $select_district = District::where('city_id', $data['value_id'])->orderby('district_id', 'ASC')->get();
                foreach($select_district as $key => $district){
                $output.='<option value="'.$district->district_id.'">'.$district->district_name.'</option>';
                }
            }else{
                $select_subdistrict = SubDistrict::where('district_id', $data['value_id'])->orderby('subdistrict_id', 'ASC')->get();
                foreach($select_subdistrict as $key => $subdistrict){
                $output.='<option value="'.$subdistrict->subdistrict_id.'">'.$subdistrict->subdistrict_name.'</option>';
                }
            }
        }
        echo $output;
    }

    public function add_cost(Request $request){
        $this->authenLogin();
        $data = $request->all();
        $shippingcost = new ShippingCost();
        $shippingcost->city_id = $data['city'];
        $shippingcost->district_id = $data['district'];
        $shippingcost->subdistrict_id = $data['subdistrict'];
        $shippingcost->cost = $data['cost'];
        $shippingcost->created_at  = new DateTime();
        $shippingcost->save();
        Session::put('message', "Insert Successfully!!!");
        return Redirect::to('/delivery-address');
    }

    public function load_delivery_cost(){
        $this->authenLogin();
        $data = ShippingCost::orderby('shippingcost_id', 'DESC')->paginate(10);
        $output = '';
        $stt = 1;
        $output .= '<div class="table-responsive">
                        <table class="table table-bordered">
                            <thread>
                                <tr>
                                    <th>#</th>
                                    <th>City</th>
                                    <th>District</th>
                                    <th>Sub-District</th>
                                    <th>Cost</th>
                                </tr>
                            </thread>
                            <tbody>
                            ';
                            foreach($data as $key => $value_cost){
                                $output.='
                                <tr>
                                    <td>'.$stt.'</td> 
                                    <td>'.$value_cost->city->city_name.'</td> 
                                    <td>'.$value_cost->district->district_name.'</td>
                                    <td>'.$value_cost->subdistrict->subdistrict_name.'</td>
                                    <td class="shippingcost_edit" contenteditable data-shippingcost_id="'.$value_cost->shippingcost_id.'">'.number_format($value_cost->cost, 0,',','.').'</td>
                                </tr>
                                ';
                                $stt += 1;
                            }
                            $output.='
                            </tbody>    
                        </table>
                    </div>
                ';
                echo $output;
            }


    public function update_delivery_cost(Request $request){
        $this->authenLogin();
        $data = $request->all();
        // $id = ShippingCost::where('shippingcost_id', $data['id']); thích dùng where thì như vầy cũng được
        $shippingcost = ShippingCost::find($data['id']); // find là tự động dùng Id để so sánh, khỏi phải where mất công
        $value_cost = rtrim($data['cost'], '.'); // cắt dấu chấm
        $shippingcost->cost = $value_cost;
        $shippingcost->save();
    }
}
