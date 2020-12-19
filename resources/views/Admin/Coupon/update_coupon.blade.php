 @extends('admin_layout')
 @section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            UPDATE COUPON
                        </header>
                        @foreach($errors->all() as $value)
                            <div class="alert alert-danger">{{$value}}</div>
                        @endforeach
                        <div class="panel-body">
                        @foreach($update_coupon as $key => $coupon_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('update-coupon/'.$coupon_value->coupon_id)}}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="namecoupon">NAME</label>
                                    <input type="text" class="form-control" value="{{$coupon_value->coupon_name}}" name="name_coupon" id="namecoupon">
                                </div>
                                <div class="form-group">
                                    <label for="codecoupon">CODE</label>
                                    <input type="text" class="form-control" value="{{$coupon_value->coupon_code}}" name="code_coupon" id="codecoupon" >
                                </div>
                                <div class="form-group">
                                    <label for="qtycoupon">QUANTITY</label>
                                    <input type="text" class="form-control" value="{{$coupon_value->coupon_qty}}" name="qty_coupon" id="qtycoupon" >
                                </div>
                                <div class="form-group">
                                    <label for="maxpromoteCoupon">MAXIMUM PROMOTE OF CART VALUE</label>
                                    <input type="number" class="form-control" value="{{$coupon_value->max_promote_value}}" name="max_promote_coupon" id="maxpromoteCoupon"  required>
                                </div>
                                <div class="form-group">
                                    <label for="modecoupon">MODE</label>
                                    <select name="mode_coupon" class="form-control m-bot15" id="selector">
                                        @if($coupon_value->coupon_mode == 0)
                                        <option  selected value="0">Percent</option>
                                        <option value="1" >Cash</option>
                                        @else
                                         <option value="0">Percent</option>
                                        <option selected value="1" >Cash</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="valuecoupon">CASH OR % VALUE</label>
                                    <input type="text" class="form-control" value="{{$coupon_value->coupon_value}}" name="value_coupon" id="valuecoupon" >
                                </div>
                                <button type="submit" name="submit_update_coupon" class="btn btn-primary btn-lg btn-block">UPDATE</button>
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection