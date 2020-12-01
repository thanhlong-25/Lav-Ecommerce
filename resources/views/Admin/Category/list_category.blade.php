 @extends('admin_layout')
 @section('admin_content')
 <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      ALL CATEGORY
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
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>#</th>
            <th>CATEGORY NAME</th>
            <th>DESCRIPTION</th>
            <th>STATUS</th>
            <th>LAST UPDATE</th>
            <th>ACTION</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

        {{-- ######################################################################################################################################################### --}}
        {{-- ######################################################################################################################################################### --}}
        @foreach($all_category as $key => $cate)
          <tr>
            <td>{{$stt}}</td>
            <td>{{$cate->cate_name}}</td>
            <td>{{$cate->cate_description}}</td>
            <td><span class="text-ellipsis">
            <?php   
                if($cate->cate_status == 0){
                    ?>
                <a href="{{URL::to('/unactive-status-cate/'.$cate->cate_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                   <?php
                }else{
                    ?>
                <a href="{{URL::to('/active-status-cate/'.$cate->cate_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                    <?php
                    }
                    ?>
            </span></td>
             <td>{{$cate->updated_at}}</td>
            <td>
              <a href="{{URL::to('edit-category/'.$cate->cate_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a href="{{URL::to('delete-category/'.$cate->cate_id)}}" onclick="return confirm('Do you want to delete?')" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
        <span>{{$all_category->links('vendor.pagination.custom_pagination')}}<span>
    </footer>
  </div>
</div>
@endsection