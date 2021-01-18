 @extends('admin_layout')
 @section('admin_content')
 <div class="table-agile-info">
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
            <th>COMMENTER</th>
            <th>PRODUCT</th>
            <th>CONTENT</th>
            <th>DATE</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>

        {{-- ######################################################################################################################################################### --}}
        {{-- ######################################################################################################################################################### --}}
        @foreach($all_comment as $key => $comment)
          <tr>
            <td>{{$stt}}</td>
            <td>{{$comment->comment_id}}</td>
            <td>{{$comment->customer->customer_name}} -- (ID: {{$comment->customer->customer_id}})</td>
            <td>{{$comment->product->product_name}} -- (ID: {{$comment->product->product_id}})</td>
            <td>{{$comment->comment_content}}
            </td>
            <td>{{$comment->created_at}}</td>
            <td>
              <a href="{{URL::to('delete-comment/'.$comment->comment_id)}}" onclick="return confirm('Do you want to delete?')" class="active"><input class="btn btn-danger btn-xs" value="Delete"></a>
              <a href="{{URL::to('delete-comment/'.$comment->comment_id)}}"><input class="btn btn-primary btn-xs " value="Reply" data-toggle="modal" data-target="#exampleModalCenter"></a>
            </td>
          </tr>
          <?php
              $stt += 1;
          ?>
          @endforeach
        </tbody>
      </table>

              {{-- Modal reply comment --}}
      <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">REPLY COMMENT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <textarea class="form-control" rows="5" disabled style="margin-bottom: 10px;">{{$comment->comment_content}}</textarea>
                
                <textarea class="form-control" rows="10">Your Reply</textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        {{-- END Modal reply comment --}}

    <footer class="panel-footer">
        <span>{{$all_comment->links('vendor.pagination.custom_pagination')}}<span>
    </footer>
  </div>
</div>
@endsection