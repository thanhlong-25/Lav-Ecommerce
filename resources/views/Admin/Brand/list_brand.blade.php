 @extends('admin_layout')
 @section('admin_content')
 <div class="table-agile-info">
 <button style="margin: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus" aria-hidden="true"></i>   Addition</button>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{URL::to('add-brand')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLongTitle">Addition Brand</h2>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nameBrand">NAME</label>
                    <input type="text" class="form-control" minlength="2" maxlength="20" name="name_brand" id="nameBrand" placeholder="Enter brand" required>
                  </div>
                  <div class="form-group">
                    <label for="descriptionBrand">DESCRIPTION</label>
                    <textarea style="resize: none" rows="8" class="form-control" minlength="2" maxlength="20" name="description_brand" id="descriptionBrand" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="selector">MODE</label>
                  <select name="status_brand" class="form-control m-bot15" id="selector">
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
            <td>{{$brand->brand_id}}</td>
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