 @extends('admin_layout')
 @section('admin_content')

@foreach($order as $key => $order_value)
 @endforeach

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
      <table class="table table-striped b-t b-light">
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
          <tr>
            <td>{{$stt}}</td>
            <td>{{$order_detail_value->product_name}}</td>
            <td>{{number_format($order_detail_value->product_price,0,',','.')}}đ</td>
            <td>{{$order_detail_value->product_sales_quantity}}</td>
          </tr>
          <?php
            $stt += 1;
          ?>
        @endforeach
        </tbody>
      </table>

      <div class="table-agile-info">
      <a target="_blank_" href="{{URL::to('print-order/'.$order_value->order_id)}}"><button type="button" class="btn btn-primary btn-lg btn-block">Print PDF</button></a> <!-- blank là khi click sẽ qua tab mới-->
     </div>
    </div>
  </div>
</div>
@endsection