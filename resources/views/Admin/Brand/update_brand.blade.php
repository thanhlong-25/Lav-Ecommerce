 @extends('admin_layout')
 @section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            UPDATE BRAND
                        </header>
                        @foreach($errors->all() as $value)
                            <div class="alert alert-danger">{{$value}}</div>
                        @endforeach
                        <div class="panel-body">
                        @foreach($update_brand as $key => $brand_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('update-brand/'.$brand_value->brand_id)}}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="namebrand">NAME</label>
                                    <input type="text" class="form-control" onkeyup="ChangeToSlug();" value="{{$brand_value->brand_name}}" name="name_brand" id="slug">
                                </div>
                                <div class="form-group">
                                    <label for="slug">SLUG</label>
                                    <input type="text" class="form-control" value="{{$brand_value->brand_slug}}" name="slug_brand" id="convert_slug" readonly>
                                </div>
                                <button type="submit" name="submit_update_brand" class="btn btn-primary btn-lg btn-block">UPDATE</button>
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection