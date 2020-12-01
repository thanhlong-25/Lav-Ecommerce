 @extends('admin_layout')
 @section('admin_content')
 <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      ALL PRODUCTS
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
            <th>PRODUCT NAME</th>
            <th>CATEGORY</th>
            <th>BRAND</th>
            <th>QUANTITY</th>
            <th>PRICE</th>
            <th>IMAGE</th>
            <th>STATUS</th>
            <th>ACTION</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

        {{-- ######################################################################################################################################################### --}}
        {{-- ######################################################################################################################################################### --}}
        @foreach($all_product as $key => $product)
          <tr>
            <td>{{$stt}}</td>
            <td>{{$product->product_name}}</td>
            <td>{{$product->cate_name}}</td>
            <td>{{$product->brand_name}}</td>
            <td>{{$product->product_qty}}</td>
            <td>{{number_format($product->product_price,0,',','.')}}</td>
            <td><img src="public/upload/products/{{$product->product_image}}" height="100px" height="100px"></td>
            <td><span class="text-ellipsis">
            <?php   
                if($product->product_status == 0){
                    ?>
                <a href="{{URL::to('/unactive-status-product/'.$product->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                   <?php
                }else{
                    ?>
                <a href="{{URL::to('/active-status-product/'.$product->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                    <?php
                    }
                    ?>
            </span></td>
            <td>
              <a href="{{URL::to('edit-product/'.$product->product_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a href="{{URL::to('delete-product/'.$product->product_id)}}" onclick="return confirm('Do you want to delete?')" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
        <span>{{$all_product->links('vendor.pagination.custom_pagination')}}<span>
    </footer>
  </div>
</div>
@endsection