 @extends('admin_layout')
 @section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            ADD PRODUCT
                        </header>
                        <?php
                            $message = Session::get('message');
                            if(strlen(strstr($message, 'wrong')) > 0){
                                echo "<p align='center'> <font color=red size='4px'> $message </font></p>";
                            }else if(strlen(strstr($message, 'Successfully')) > 0){
                                echo "<p align='center'> <font color=green size='4px'> $message </font></p>";
                            }
                            Session::forget('message');
	                    ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('save-product')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="nameproduct">NAME</label>
                                    <input type="text" class="form-control" name="name_product" id="nameproduct" placeholder="Enter name product" required>
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
                                    <label for="contentproduct">CONTENT</label>
                                    <input type="text" class="form-control" name="content_product" id="contentproduct" required>
                                </div>
                                <div class="form-group">
                                    <label for="qtyproduct">QUANTITY</label>
                                    <input type="number" class="form-control" name="qty_product" id="qtyproduct" required>
                                </div>
                                <div class="form-group">
                                    <label for="priceproduct">PRICE</label>
                                    <input type="number" class="form-control" name="price_product" id="priceproduct" required>
                                </div>
                                <div class="form-group">
                                    <label for="imageproduct">IMAGE</label>
                                    <input type="file" class="form-control" name="image_product" id="imageproduct" required>
                                </div>
                                <div class="form-group">
                                <label for="selector">MODE</label>
                                    <select name="status_product" class="form-control m-bot15" id="selector">
                                        <option value="0" >Hide</option>
                                        <option value="1" >Show</option>
                                    </select>
                                </div>
                                <button type="submit" name="submit_add_product" class="btn btn-primary btn-lg btn-block">ADD</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection