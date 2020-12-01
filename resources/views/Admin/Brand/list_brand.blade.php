 @extends('admin_layout')
 @section('admin_content')
 <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      ALL BRANDS
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
            <th>BRAND NAME</th>
            <th>DESCRIPTION</th>
            <th>STATUS</th>
            <th>LAST UPDATE</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>

        {{-- ######################################################################################################################################################### --}}
        {{-- ######################################################################################################################################################### --}}
        @foreach($all_brand as $key => $brand)
          <tr>
            <td>{{$stt}}</td>
            <td>{{$brand->brand_name}}</td>
            <td>{{$brand->brand_description}}</td>
            <td>
            <?php   
                if($brand->brand_status == 0){
                    ?>
                <a href="{{URL::to('/unactive-status-brand/'.$brand->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                   <?php
                }else{
                    ?>
                <a  href="{{URL::to('/active-status-brand/'.$brand->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                    <?php
                    }
                    ?>
            </td>
            <td>{{$brand->updated_at}}</td>
            <td>
              <a href="{{URL::to('edit-brand/'.$brand->brand_id)}}" class="active"><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a href="{{URL::to('delete-brand/'.$brand->brand_id)}}" onclick="return confirm('Do you want to delete?')" class="active"><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          <?php
              $stt += 1;
          ?>
          @endforeach
        </tbody>
      </table>

    <footer class="panel-footer">
        <span>{{$all_brand->links('vendor.pagination.custom_pagination')}}<span>
    </footer>
  </div>
</div>
@endsection