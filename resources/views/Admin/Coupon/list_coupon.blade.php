 @extends('admin_layout')
 @section('admin_content')
 <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      ALL COUPON
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
            <th>COUPON NAME</th>
            <th>CODE</th>
            <th>QUANTITY</th>
            <th>MAX PROMOTE</th>
            <th>MODE</th>
            <th>PROMOTE</th>
            <th>ACTION</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

        {{-- ######################################################################################################################################################### --}}
        {{-- ######################################################################################################################################################### --}}
        @foreach($all_coupon as $key => $coupon)
          <tr>
            <td>{{$stt}}</td>
            <td>{{$coupon->coupon_name}}</td>
            <td>{{$coupon->coupon_code}}</td>
            <td>{{$coupon->coupon_qty}}</td>
            <td>{{$coupon->max_promote_value}}</td>
            <td>
                <?php
                  if($coupon->coupon_mode == 0){
                ?>
                  Percent
                <?php
                  }else if($coupon->coupon_mode == 1){
                ?>
                  Cash
                <?php
                  }
                ?>
            </td>
            <td>
                <?php
                  if($coupon->coupon_mode == 0){
                ?>
                  {{$coupon->coupon_value}} %
                <?php
                  }else if($coupon->coupon_mode == 1){
                ?>
                  {{number_format($coupon->coupon_value,0,',','.')}} đ
                <?php
                  }
                ?>
            <td>
              <a href="{{URL::to('edit-coupon/'.$coupon->coupon_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a href="{{URL::to('delete-coupon/'.$coupon->coupon_id)}}" onclick="return confirm('Do you want to delete?')" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
           <?php
              $stt += 1;
          ?>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
        <span>{{$all_coupon->links('vendor.pagination.custom_pagination')}}<span>
    </footer>
  </div>
</div>
@endsection