 @extends('admin_layout')
 @section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            UPDATE PRODUCT
                        </header>
                        @foreach($errors->all() as $value)
                            <div class="alert alert-danger">{{$value}}</div>
                        @endforeach
                        <div class="panel-body">
                        @foreach($update_product as $key => $product_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('update-product/'.$product_value->product_id)}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="nameproduct">NAME</label>
                                    <input type="text" class="form-control" onkeyup="ChangeToSlug();" value="{{$product_value->product_name}}" name="name_product" id="slug" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="slug">SLUG</label>
                                    <input type="text" class="form-control" value="{{$product_value->product_slug}}" name="slug_product" id="convert_slug" readonly>
                                </div>

                                <div class="form-group">
                                <label for="selector">CATEGORY</label>
                                    <select name="cate_id_product" class="form-control m-bot15" id="selector">
                                       @foreach($all_cate as $key => $all_cate)
                                        @if($all_cate->cate_id == $product_value->cate_id)
                                            <option selected value="{{$all_cate->cate_id}}">{{$all_cate->cate_name}}</option>
                                        @else
                                            <option value="{{$all_cate->cate_id}}">{{$all_cate->cate_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="selector">BRAND</label>
                                    <select name="brand_id_product" class="form-control m-bot15" id="selector">
                                        <@foreach($all_brand as $key => $all_brand)
                                        {{-- Chọn cate và brand đúng của sản phẩm --}}
                                        @if($all_brand->brand_id == $product_value->brand_id)
                                            <option selected value="{{$all_brand->brand_id}}" >{{$all_brand->brand_name}}</option>
                                        @else
                                            <option value="{{$all_brand->brand_id}}" >{{$all_brand->brand_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="descriptionproduct">DESCRIPTION</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="description_product" id="descriptionproduct">{{$product_value->product_description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="inventoryproduct">QUANTITY</label>
                                    <input type="number" class="form-control" value="{{$product_value->product_inventory}}" name="inventory_product" id="inventoryproduct">
                                </div>
                                <div class="form-group">
                                    <label for="priceproduct">PRICE</label>
                                    <input type="number" class="form-control" value="{{$product_value->product_price}}" name="price_product" id="priceproduct">
                                </div>
                                <div class="form-group">
                                    <label for="imageproduct">IMAGE</label>
                                    <input type="file" class="form-control" name="image_product" id="imageproduct" accept="image/*" onchange="loadFile(event)">
                                    <img src="{{URL::to('public/upload/products/'.$product_value->product_image)}}" height="300px" width="480px" style="padding:10px" >
                                    <img src="{{URL::to('public/backEnd/images/none_image.jpg')}}" id="output" width="480px" height="300px" style="padding:10px" />
                                </div>
                                
                                <button type="submit" name="submit_update_product" class="btn btn-primary btn-lg btn-block">UPDATE</button>
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection