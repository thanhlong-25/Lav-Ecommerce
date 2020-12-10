 @extends('admin_layout')
 @section('admin_content')
@foreach($order as $key => $order_value)
@endforeach

<input type="hidden" name="order_id" id="order_id" value="{{$order_value->order_id}}">

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      SHIPPING INFORMATION
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
          <th>#</th>
            <th>ADDRESS</th>
            <th>PHONE</th>
            <th>EMAIL</th>
            <th>NOTE</th>
            <th>DATE</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td>{{$order_value->shipping_address}}</td>
            <td>{{$order_value->shipping_phone}}</td>
            <td>{{$order_value->shipping_email}}</td>
            <td>{{$order_value->shipping_note}}</td>
            <td>{{$order_value->created_at}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
{{-- Table 3 #######################################################################################################################--}}
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      ORDER DETAILS
    </div>
    <div class="table-responsive">
      <table class="table ">
        <thead>
          <tr>
            <th>#</th>    
            <th>PRODUCT NAME</th>
            <th>PRODUCT PRICE</th>
            <th>QUANTITY</th>           
          </tr>
        </thead>
        <tbody>
         <?php
          $stt = 1;
          ?>
        @foreach($order_detail as $key => $order_detail_value)
          <tr class="row_status_{{$order_detail_value->product_id}}">
            <td>{{$stt}}</td>
            <td>{{$order_detail_value->product_name}}</td>
            <td>{{number_format($order_detail_value->product_price,0,',','.')}}đ</td>
            <td value="{{$order_detail_value->product_sales_quantity}}">{{$order_detail_value->product_sales_quantity}}</td>
            <input type="hidden" name="product_id" id="product_id" value="{{$order_detail_value->product_id}}">
            <input type="hidden" name="product_sales_quantity" id="product_sales_quantity" value="{{$order_detail_value->product_sales_quantity}}">
            <input type="hidden" id="product_inventory_{{$order_detail_value->product_id}}" value="{{$order_detail_value->product_inventory}}">
          </tr>
          <?php
            $stt += 1;
          ?>
        @endforeach
        </tbody>
      </table>

  <div class="table-agile-info">
      <form role="form" method="POST">
        {{ csrf_field() }}
        <select id="change_order_status" name="order_status" class="form-control form-group mb-2">      
                @if($order_value->order_status == 'Chờ xử lí')
                  <option selected value="Chờ xử lí">Chờ xử lí</option>
                  <option value="Đang giao hàng">Đang giao hàng</option>
                  <option value="Đã giao">Đã giao</option>
                  <option value="Đã huỷ">Đã huỷ</option>
                @elseif($order_value->order_status == 'Đang giao hàng')
                  <option selected value="Đang giao hàng">Đang giao hàng</option>
                  <option value="Đã giao">Đã giao</option>
                  <option value="Đã huỷ">Đã huỷ</option>
                @elseif($order_value->order_status == 'Đã giao')
                  <option selected value="Đã giao">Đã giao</option>
                  <option value="Đã huỷ">Đã huỷ</option>
                @elseif($order_value->order_status == 'Đã huỷ')
                  <option selected value="Đã huỷ">Đã huỷ</option>
              @endif
        </select>
      </form>  
</div>

    <div class="table-agile-info">
      <a target="_blank_" href="{{URL::to('print-order/'.$order_value->order_id)}}"><button type="button" class="btn btn-primary btn-lg btn-block">Print PDF</button></a> <!-- blank là khi click sẽ qua tab mới-->
     </div>
    </div>
  </div>
</div>
@endsection