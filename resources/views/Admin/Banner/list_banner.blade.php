 @extends('admin_layout')
 @section('admin_content')
 <div class="table-agile-info">
 <button style="margin: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus" aria-hidden="true"></i>   Addition</button>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{URL::to('add-banner')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLongTitle">Addition Banner</h2>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nameBanner">NAME</label>
                    <input type="text" class="form-control" minlength="2" maxlength="50" name="name_banner" id="nameBanner" required>
                  </div>
                  <div class="form-group">
                    <label for="imageBanner">IMAGE</label>
                    <input type="file" class="form-control" name="image_banner" id="imageBanner" required>
                  </div>
                  <div class="form-group">
                    <label for="selector">MODE</label>
                    <select name="status_banner" class="form-control m-bot15" id="selector">
                      <option value="1" >Show</option>
                      <option value="0" >Hide</option>
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
            <td>{{$banner_value->banner_id}}</td>
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