 @extends('admin_layout')
 @section('admin_content')
 <div class="table-agile-info">
     <button style="margin: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus" aria-hidden="true"></i> Addition</button>
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
                             <input type="text" class="form-control" onkeyup="ChangeToSlug();" name="name_category" id="slug" placeholder="Enter Category">
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">SLUG</label>
                             <input type="text" name="slug_category" class="form-control" id="convert_slug" placeholder="Slug" readonly>
                         </div>
                         <div class="form-group">
                             <label for="selector">MODE</label>
                             <select name="status_category" class="form-control m-bot15" id="selector">
                                 <option value="0">Hide</option>
                                 <option value="1">Show</option>
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
         <table id="myTable" class="table table-striped b-t b-light">
             <thead>
                 <tr>
                     <th>#</th>
                     <th>ID</th>
                     <th>CATEGORY NAME</th>
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
                     <td>{{$cate->cate_id}}</td>
                     <td>{{$cate->cate_name}}</td>
                     <td><span class="text-ellipsis">
                             <?php   
                if($cate->cate_status == 0){
                    ?>
                             <a href="{{URL::to('/inactive-status-cate/'.$cate->cate_id)}}"><input class="btn btn-danger btn-xs" value="Inactive"></a>
                             <?php
                }else{
                    ?>
                             <a href="{{URL::to('/active-status-cate/'.$cate->cate_id)}}"><input class="btn btn-success btn-xs" value="Active"></a>
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
