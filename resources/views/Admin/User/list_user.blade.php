 @extends('admin_layout')
 @section('admin_content')
 <div class="table-agile-info">
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
            <th>USERNAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th>CREATED AT</th>
            <th>ACTION</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

        {{-- ######################################################################################################################################################### --}}
        {{-- ######################################################################################################################################################### --}}
        @foreach($all_user as $key => $user_value)
          <tr>
            <td>{{$stt}}</td>
            <td>{{$user_value->customer_id}}</td>
            <td>{{$user_value->customer_name}}</td>
            <td>{{$user_value->customer_email}}</td>
            <td>{{$user_value->customer_phone}}</td>
            <td>{{$user_value->created_at}}</td>
            <td><a href="{{URL::to('delete-user/'.$user_value->customer_id)}}" onclick="return confirm('Do you want to delete?')" class="active"><i class="fa fa-times text-danger text"></i></a></td>
          </tr>
           <?php
              $stt += 1;
          ?>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
        <span>{{$all_user->links('vendor.pagination.custom_pagination')}}<span>
    </footer>
  </div>
</div>
@endsection