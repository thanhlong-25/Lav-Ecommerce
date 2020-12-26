 @extends('admin_layout')
 @section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            UPDATE CATEGORY
                        </header>
                        @foreach($errors->all() as $value)
                            <div class="alert alert-danger">{{$value}}</div>
                        @endforeach
                        <div class="panel-body">
                        @foreach($update_category as $key => $cate_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('update-category/'.$cate_value->cate_id)}}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="nameCategory">NAME</label>
                                    <input type="text" class="form-control" onkeyup="ChangeToSlug();" value="{{$cate_value->cate_name}}" name="name_category" id="slug" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="slug">SLUG</label>
                                    <input type="text" class="form-control" value="{{$cate_value->cate_slug}}" name="slug_category" id="convert_slug" readonly>
                                </div>
                                <button type="submit" name="submit_update_category" class="btn btn-primary btn-lg btn-block">UPDATE</button>
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection