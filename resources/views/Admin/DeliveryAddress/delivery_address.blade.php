 @extends('admin_layout')
 @section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            ADD DELIVERY ADDRESS
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
                                <form role="form" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                <label>CITY - PROVINCE</label>
                                    <select name="city_province" class="form-control m-bot15 choose" id="city_province_id">
                                    @foreach($city as $key => $city_value)
                                        <option value="{{$city_value->city_id}}">{{$city_value->city_name}}</option>
                                    @endforeach   
                                    </select>
                                </div>
                                <div class="form-group">
                                <label >DISTRICT</label>
                                    <select name="district" class="form-control m-bot15 choose" id="district_id">
                                    <option >-----Select-----</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                <label >SUB-DISTRICTS</label>
                                    <select name="subdistrict" class="form-control m-bot15" id="subdistrict_id">                  
                                        <option >-----Select-----</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="shippingcost">SHIPPING FEE</label>
                                    <input type="text" class="form-control" name="shippingcost" id="shippingcost" required>
                                </div>
                                <button type="button" id="add_shippingcost" class="btn btn-primary btn-lg btn-block" style="margin-bottom: 10px">ADD</button>
                            </form>
                            </div>
                            <div id="load_delivery_cost">
                            </div>
                    </div>
                    
            </section>
        </div>
@endsection
