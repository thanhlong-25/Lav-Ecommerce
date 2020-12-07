 @extends('admin_layout')
 @section('admin_content')
 <div class="table-agile-info">
 <button style="margin: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus" aria-hidden="true"></i>   Addition</button>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{URL::to('add-category')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLongTitle">Addition Category</h2>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nameCategory">NAME</label>
                    <input type="text" class="form-control" name="name_category" id="nameCategory" placeholder="Enter Category">
                  </div>
                  <div class="form-group">
                    <label for="descriptionCategory">DESCRIPTION</label>
                    <textarea style="resize: none" rows="8" class="form-control" name="description_category" id="descriptionCategory" maxlength="200" minlength="4" pattern="^[a-zA-Z0-9_.-]*$" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="selector">MODE</label>
                      <select name="status_category" class="form-control m-bot15" id="selector">
                        <option value="0" >Hide</option>
                        <option value="1" >Show</option>
                      </select>
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