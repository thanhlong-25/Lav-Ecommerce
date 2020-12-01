 @extends('admin_layout')
 @section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            UPDATE BRAND
                        </header>
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo "<p align='center'> <font color=green size='2px'> $message </font></p>";
                                Session::forget('message');
                            }
	                    ?>
                        <div class="panel-body">
                        @foreach($update_brand as $key => $brand_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('update-brand/'.$brand_value->brand_id)}}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="namebrand">NAME</label>
                                    <input type="text" class="form-control" value="{{$brand_value->brand_name}}" name="name_brand" id="namebrand" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="descriptionbrand">DESCRIPTION</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="description_brand" id="descriptionbrand">{{$brand_value->brand_description}}</textarea>
                                </div>
                                
                                <button type="submit" name="submit_update_brand" class="btn btn-primary btn-lg btn-block">UPDATE</button>
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection