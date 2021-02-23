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
use App\Models\Statistics;
use App\Models\Banner;
use DateTime;
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();

class StatisticsController extends Controller
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

    public function filter_by_date(Request $request){
        $this->authenLogin();
        $data = $request->all();
        $form_date = $data['form_date'];
        $to_date = $data['to_date'];

        $filter = Statistics::whereBetween('stat_date', [$form_date, $to_date])->orderBy('stat_date', 'ASC')->get();
        
        foreach ($filter as $key => $val){
            $chart_data[] = array(
                'date' => $val->stat_date,
                'sale' => $val->stat_sales,
                'profit' => $val->stat_profits,
                'quantity' => $val->total_quantities,
                'total_order' => $val->total_orders,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function filter_by_option(Request $request){
        $this->authenLogin();
        $data = $request->all();
        $option_val = $data['option_val'];

        $today = Carbon::today();
        $start_thisweek = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->toDateString();

        $start_lastweek = Carbon::now('Asia/Ho_Chi_Minh')->subWeek()->startOfWeek()->toDateString();
        $end_lastweek = Carbon::now('Asia/Ho_Chi_Minh')->subWeek()->endOfWeek()->toDateString();

        $start_lastmonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_lastmonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $lastyear = Carbon::now('Asia/Ho_Chi_Minh')->subDay(365)->toDateString();

        if($option_val == "thisweek"){
            $filter = Statistics::where('stat_date', [$start_thisweek, $today])->orderBy('stat_date', 'ASC')->get();
        }else if($option_val == "lastweek"){
            $filter = Statistics::whereBetween('stat_date', [$start_lastweek, $end_lastweek])->orderBy('stat_date', 'ASC')->get();
        }else if($option_val == "lastmonth"){
            $filter = Statistics::whereBetween('stat_date', [$start_lastmonth, $end_lastmonth])->orderBy('stat_date', 'ASC')->get();
        }else if($option_val == "lastyear"){
            $filter = Statistics::whereBetween('stat_date', [$lastyear, $today])->orderBy('stat_date', 'ASC')->get();
        }else{
        }

        foreach ($filter as $key => $val){
            $chart_data[] = array(
                'date' => $val->stat_date,
                'sale' => $val->stat_sales,
                'profit' => $val->stat_profits,
                'quantity' => $val->total_quantities,
                'total_order' => $val->total_orders,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function load_chart(Request $request){
        $this->authenLogin();
        $data = $request->all();

        $today = Carbon::now();
        $seven_dayago = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();

        $filter = Statistics::whereBetween('stat_date', [$seven_dayago, $today])->orderBy('stat_date', 'ASC')->get();
        foreach ($filter as $key => $val){
            $chart_data[] = array(
                'date' => $val->stat_date,
                'sale' => $val->stat_sales,
                'profit' => $val->stat_profits,
                'quantity' => $val->total_quantities,
                'total_order' => $val->total_orders,
            );
        }
        echo $data = json_encode($chart_data);
    }
}
