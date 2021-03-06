 @extends('admin_layout')
 @section('admin_content')
 <div class="table-agile-info">
 <button style="margin: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus" aria-hidden="true"></i>   Addition</button>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{URL::to('add-product')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLongTitle">Addition Product</h2>
                </div>
                <div class="modal-body">
                                <div class="form-group">
                                    <label for="nameproduct">NAME</label>
                                    <input type="text" class="form-control" name="name_product" onkeyup="ChangeToSlug();" id="slug" placeholder="Enter name product" required>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">SLUG</label>
                                  <input type="text" name="slug_product" class="form-control" id="convert_slug" placeholder="Slug" readonly>
                                </div>
                                <div class="form-group">
                                <label for="selector">CATEGORY</label>
                                    <select name="cate_id_product" class="form-control m-bot15" id="selector">
                                       @foreach($all_cate as $key => $all_cate)
                                        <option value="{{$all_cate->cate_id}}" >{{$all_cate->cate_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="selector">BRAND</label>
                                    <select name="brand_id_product" class="form-control m-bot15" id="selector" >
                                        <@foreach($all_brand as $key => $all_brand)
                                        <option value="{{$all_brand->brand_id}}" >{{$all_brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="descriptionproduct">DESCRIPTION</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="description_product" id="descriptionproduct" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="inventoryproduct">INVENTORY</label>
                                    <input type="number" class="form-control" name="inventory_product" id="inventoryproduct" required>
                                </div>
                                <div class="form-group">
                                    <label for="priceproduct">PRICE</label>
                                    <input type="text" class="form-control" name="price_product" id="priceproduct" required>
                                </div>
                                <div class="form-group">
                                    <label for="imageproduct">IMAGE</label>
                                    <input type="file" class="form-control" name="image_product" id="imageproduct" accept="image/*" onchange="loadFile(event)" required>
                                    <img src="{{URL::to('public/backEnd/images/none_image.jpg')}}" id="output" width="550px" height="300px" style="padding:10px" />
                                </div>
                                <div class="form-group">
                                <label for="selector">MODE</label>
                                    <select name="status_product" class="form-control m-bot15" id="selector">
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
      <table id="myTable" class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>ID</th>
            <th>PRODUCT NAME</th>
            <th>CATEGORY</th>
            <th>BRAND</th>
            <th>INVENTORY</th>
            <th>SOLD</th>
            <th>PRICE</th>
            <th>VIEW</th>
            <th>GALLERY</th>
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
            <td>{{$product->product_id}}</td>
            <td>{{$product->product_name}}</td>
            <td>{{$product->cate_name}}</td>
            <td>{{$product->brand_name}}</td>
            <td>{{$product->product_inventory}}</td>
            <td>{{$product->product_sold}}</td>
            <td>{{number_format($product->product_price,0,',','.')}}</td>
            <td>{{$product->product_views}}</td>
            <td><a href="{{url('list-gallery/'.$product->product_id)}}"><input class="btn btn-primary btn-xs" value="Gallery"></a></td>
            <td><img src="public/upload/products/{{$product->product_image}}" height="100px" height="100px"></td>
            <td><span class="text-ellipsis">
            <?php   
                if($product->product_status == 0){
                    ?>
                <a href="{{URL::to('/inactive-status-product/'.$product->product_id)}}"><input class="btn btn-danger btn-xs" value="Inactive"></a>
                   <?php
                }else{
                    ?>
                <a href="{{URL::to('/active-status-product/'.$product->product_id)}}"><input class="btn btn-success btn-xs" value="Active"></a>
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