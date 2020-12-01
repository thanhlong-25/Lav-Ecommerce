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
            <th>BANNER NAME</th>
            <th>BANNER IMAGE</th>
            <th>STATUS</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>

        {{-- ######################################################################################################################################################### --}}
        {{-- ######################################################################################################################################################### --}}
          @foreach($banner as $key => $banner_value)
          <tr>
            <td>{{$stt}}</td>
            <td>{{$banner_value->banner_name}}</td>
            <td><img src="public/upload/banners/{{$banner_value->banner_image}}" height="100px" height="100px"></td>
            <td>
            <?php   
                if($banner_value->banner_status == 0){
                    ?>
                <a href="{{URL::to('/unactive-status-banner/'.$banner_value->banner_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                   <?php
                }else{
                    ?>
                <a  href="{{URL::to('/active-status-banner/'.$banner_value->banner_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                    <?php
                    }
                ?>
            </td>
            <td>
              <a href="{{URL::to('delete-banner/'.$banner_value->banner_id)}}" onclick="return confirm('Do you want to delete?')" class="active"><i class="fa fa-times text-danger text"></i></a>
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
        <span>{{$banner->links('vendor.pagination.custom_pagination')}}<span>
    </footer>
  </div>
</div>
@endsection