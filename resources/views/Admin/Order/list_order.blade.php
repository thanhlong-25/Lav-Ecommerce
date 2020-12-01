 @extends('admin_layout')
 @section('admin_content')
 <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      ALL orderS
    </div>
    
    <?php
        $stt = 1;
        $message = Session::get('message_status');
         if(strlen(strstr($message, 'Hidden')) > 0){
            echo "<p align='center'> <font color=red size='4px'> $message </font></p>";
          }else if(strlen(strstr($message, 'Show')) > 0){
            echo "<p align='center'> <font color=green size='4px'> $message </font></p>";
          }
        Session::forget('message_status');
	    ?>

      <?php
        $message = Session::get('message');
        if($message){
            echo "<p align='center'> <font color=green size='4px'> $message </font></p>";
        }
        Session::forget('message');
	    ?>

   
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>#</th>
            <th>ORDER OWNER</th>
            <th>PAYMENT</th>
            <th>COUPON USED</th>
            <th>ORDER VALUE</th>
            <th>STATUS</th>
            <th>ORDER DATE</th>
            <th>CONTROL</th>
          </tr>
        </thead>
        <tbody>

        {{-- ######################################################################################################################################################### --}}
        {{-- ######################################################################################################################################################### --}}
        @foreach($all_order as $key => $order)
          <tr>
            <td>{{$stt}}</td>
            <td>{{$order->shipping_name}}</td>
            <td>{{$order->payment_method}}</td>
            <td>{{number_format($order->coupon_code,0,',','.')}}đ</td>
            <td>{{number_format($order->order_total,0,',','.')}}đ</td>
            <td contenteditable>{{$order->order_status}}</td>
            <td>{{$order->created_at}}</td>
            <td><a href="{{URL::to('view-order/'.$order->order_id)}}" class="active"><i class="fa fa-eye text-success text-active"></i></a></td>
          </tr>
          <?php
              $stt += 1;
          ?>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
        <span>{{$all_order->links('vendor.pagination.custom_pagination')}}<span>
    </footer>
  </div>
</div>
@endsection