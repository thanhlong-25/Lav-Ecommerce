@extends('admin_layout')
@section('admin_content')
<style type="text/css">
    p.title_stat {
        text-align: center;
        font-size: 20px;
        background: #47a447;
        color: #fff;
        height: 30px
    }

</style>
{{-- // FILTER FIELD --}}
<div class="row">
    <form class="form-inline">
        @csrf
        <div class="form-group mb-2" style="margin: 5px">
            <label for="datepickerform" class="sr-only">Form</label>
            <input type="date" class="form-control" id="datepickerform">
        </div>
        <div class="form-group mb-2" style="margin: 5px">
            <label for="datepickerto" class="sr-only">To</label>
            <input type="date" class="form-control" id="datepickerto">
        </div>
        <button type="button" id="btn-dashboard-filter" class="btn btn-success mb-2" style="margin: 5px">Filter</button>
    </form>
</div>
<div class="row">
    <div class="col-md-2">
        <select class="form-control" name="filter" id="option-filter">
            <option selected>-- Select--</option>
            <option value="thisweek">This week</option>
            <option value="lastweek">Last week</option>
            <option value="lastmonth">Last month</option>
            <option value="lastyear">Last year</option>
        </select>
    </div>
</div>

{{-- CHART FIELD --}}
<p class="title_stat">THỐNG KÊ DOANH THU, LỢI NHUẬN</p>
<div class="row">
    <div class="col-md-12">
        <div id="myfirstchart" style="height: 250px;"></div>
    </div>
</div>

<p class="title_stat">THỐNG KÊ SỐ LƯỢNG HÀNG, ĐƠN HÀNG</p>
<div class="row">
    <div class="col-md-12">
        <div id="mysecondchart" style="height: 250px;"></div>
    </div>
</div>

<p class="title_stat">THỐNG KÊ TRUY CẬP</p>
<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Đang online</th>
                <th scope="col">Hôm nay</th>
                <th scope="col">Tuần này</th>
                <th scope="col">Tháng này</th>
                <th scope="col">Tổng truy cập</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>{{$count_current}}</th>
                <td>{{$accessTime_today}}</td>
                <td>{{$accessTime_week}}</td>
                <td>{{$accessTime_month}}</td>
                <td>{{$count_visitor}}</td>
            </tr>
        </tbody>
    </table>
</div>

<p class="title_stat">THỐNG KÊ SẢN PHẨM</p>
<div class="row">
    <div class="col-md-4">
        <div id="donut-example" class="morris-donut-inverse"></div>
    </div>
    <div class="col-md-3">
        <h3>Sản phẩm bán chạy</h3>
        <ul class="list-group">
            @foreach($best_seller_product as $key => $best_seller_value)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{URL::to('chi-tiet-san-pham/'.$best_seller_value->product_slug)}}" target="_blank">{{$best_seller_value->product_name}}</a>
                <span class="label label-success">{{$best_seller_value->product_sold}}</span>
            </li>
            @endforeach
        </ul>

    </div>
    <div class="col-md-3">
        <h3>Sản phẩm gần hết hàng</h3>
        <ul class="list-group">
            @foreach($almost_out_product as $key => $almost_out_product_value)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{URL::to('chi-tiet-san-pham/'.$almost_out_product_value->product_slug)}}" target="_blank">{{$almost_out_product_value->product_name}}</a>
                <span class="label label-danger">{{$almost_out_product_value->product_inventory}}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
