 @extends('admin_layout')
 @section('admin_content')
 <div class="table-agile-info">
 <button style="margin: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus" aria-hidden="true"></i>   Addition</button>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{URL::to('add-coupon')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLongTitle">Addition Coupon</h2>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nameCoupon">NAME</label>
                      <input type="text" class="form-control" minlength="2" maxlength="20" name="name_coupon" id="nameCoupon"  required>
                  </div>
                  <div class="form-group">
                    <label for="codeCoupon">CODE</label>
                    <input type="text" class="form-control" minlength="2" maxlength="20" name="code_coupon" id="codeCoupon" required>
                  </div>
                  <div class="form-group">
                    <label for="qtyCoupon">QUANTITY</label>
                    <input type="number" class="form-control" name="qty_coupon" id="qtyCoupon"  required>
                  </div>
                  <div class="form-group">
                    <label for="maxpromoteCoupon">MAXIMUM PROMOTE OF CART VALUE</label>
                    <input type="number" class="form-control" name="max_promote_coupon" id="maxpromoteCoupon"  required>
                  </div>
                  <div class="form-group">
                    <label for="selector">MODE</label>
                      <select name="mode_coupon" class="form-control m-bot15" id="selector">
                        <option>-----Select------</option>
                        <option value="0" >Percent</option>
                        <option value="1" >Cash</option>
                       </select>
                  </div>
                  <div class="form-group">
                    <label for="valueCoupon">CASH OR % VALUE</label>
                    <input type="number" class="form-control" name="value_coupon" id="valueCoupon" placeholder="Enter value" required>
                  </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
    @foreach($errors->all() as $value)
        <div class="alert alert-danger">{{$value}}</div>
    @endforeach
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
            <th>ID</th>
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
            <td>{{$coupon->coupon_id}}</td>
            <td>{{$coupon->coupon_name}}</td>
            <td>{{$coupon->coupon_code}}</td>
            <td>{{$coupon->coupon_qty}}</td>
            <td>{{number_format($coupon->max_promote_value,0,',','.')}} đ</td>
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