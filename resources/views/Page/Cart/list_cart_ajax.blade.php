@extends('welcome')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ul class="breadcrumb">
                <h2 class="title text-center">Giỏ hàng của bạn</h2>
            </ul>
        </div>

{{-- Session Message --}}
@if(session()->has('message'))
    <div class="alert alert-success">
    {{session() -> get('message')}}
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger">
    {{session() -> get('error')}}
    </div>
@endif
{{-- End Session Message --}}

    <div class="table-responsive cart_info">
        <form action="{{URL::to('update-cart')}}" method="POST">
            {{csrf_field()}}
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu" style="text-align: center; vertical-align: middle;">
                        <td class="col-sm-3">Hình ảnh</td>
                        <td class="col-sm-2">Sản phẩm</td>
                        <td class="col-sm-2">Giá</td>
                        <td>Số lượng</td>
                        <td class="col-sm-2">Tổng</td>
                        <td class="col-sm-2">Thao tác</td>
                    </tr>
                </thead>
                <tbody>
<?php
    $total = 0;
    $total_promote = 0;
    $session_cart = Session::get('cart');
?>
    @if(Session::get('cart') == true)
<?php
    $session_cart = Session::get('cart');
    echo "<pre>";
    print_r($session_cart);
    echo "</pre>";
?>
<?php
    $total = 0;
    $session_cart = Session::get('cart');
?>
@foreach($session_cart as $key => $value_cart)
<?php
    $subtotal = $value_cart['product_qty'] * $value_cart['product_price'];
    $total+=$subtotal;
?>
                    <tr style="text-align: center; vertical-align: middle;">
                        <td class="col-sm-3"><img src="{{URL::to('public/upload/products/'.$value_cart['product_image'])}}" height="200px" width="160px" /></td>
                        <td class="col-sm-2">{{$value_cart['product_name']}}</td>
                        <td>{{number_format($value_cart['product_price'],0,',','.')}}đ</td>
                        <td><input type="number" name="cart_qty[{{$value_cart['session_id']}}]" min="1" value="{{$value_cart['product_qty']}}"></td>
                        <td class="col-sm-2">{{number_format($subtotal,0,',','.')}}đ</td>
                        <td class="cart_delete col-sm-2"><a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$value_cart['session_id'])}}"><i class="fa fa-times"></i></a></td>
                    </tr>
@endforeach
                    <td><button style="margin: 5px;" type="submit" class="btn btn-success btn-sm">Cập nhật giỏ hàng</button></td>
@else
                    <tr> <div class="alert alert-danger">Chưa có sản phẩm nào trong giỏ</div></tr>
@endif
                </tbody>
            </table>
        </form>
    </div>
{{-- coupon --}}
    <form action="{{URL::to('check-coupon')}}" method="POST">
            {{csrf_field()}}
        <div class="row">
            <div class="col col-lg-10">
                <div class="total_area">
                    <ul>
                        <li>Tổng<span>{{number_format($total,0,',','.')}}đ</span></li>
                        <li>Mã giảm Giá
                            @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key => $value)
                                    @if($value['coupon_mode'] == 1)
                                        <span>({{$value['coupon_code']}}) --- {{number_format($value['coupon_value'],0,',','.')}}đ</span>
                                            <?php
                                                $total_promote = $value['coupon_value'];
                                                if($total_promote > $value['max_promote_value'])
                                                $total_promote = $value['max_promote_value'];
                                            ?>
                                    @elseif($value['coupon_mode'] == 0)
                                        <span>({{$value['coupon_code']}}) --- {{$value['coupon_value']}}%  -- Tối đa: {{number_format($value['max_promote_value'],0,',','.')}}đ</span>
                                            <?php
                                                $total_promote = ($total*$value['coupon_value'])/100;
                                                if($total_promote > $value['max_promote_value'])
                                                $total_promote = $value['max_promote_value'];
                                            ?>
                                    @endif
                                @endforeach
                            @endif
                        </li>
                        <li>Tiền đã giảm <span>{{number_format($total_promote,0,',','.')}}đ</span></li>
                        <li>Phí vận chuyển <span>30.000đ</span></li>
                        <li>Thành tiền<span>{{number_format($total - $total_promote + 30000,0,',','.')}}đ</span></li>
                        <li><input type="text" name ="coupon_check" placeholder="Mã giảm giá"></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-12" style="justify-content: center; display: flex;">
                <button style="margin: 5px;" type="submit" class="btn btn-success btn-sm">Kiểm tra đơn</button>
                <button style="margin: 5px;" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Mua hàng</button>
            </div>
        </div>
    </form>
			
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{URL::to('send-orther')}}" method="post">
                {{csrf_field()}}
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLongTitle">Mua hàng</h2>
                    </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Người nhận:</label>
                    <input type="text" name="shipping_name" class="form-control" placeholder="Tên người nhận">
                </div>
                    <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Email:</label>
                    <input type="email" name="shipping_email" class="form-control" placeholder="Email">
                </div>
{{-------------------------------------------------------------------------}}
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="city_province_id">Tỉnh - Thành Phố</label>
                        <select name="city_province" id="city_province_id" class="form-control choose">
                            @foreach($city as $key => $city_value)
                                <option value="{{$city_value->city_id}}">{{$city_value->city_name}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="district_id">Quận - Huyện</label>
                        <select name="district" id="district_id" class="form-control choose">
                            <option>Select</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="subdistrict_id">Phường - Thị xã</label> 
                        <select name="subdistrict" id="subdistrict_id" class="form-control">
                            <option>Select</option>
                        </select>
                    </div>
                </div>
{{-------------------------------------------------------------------------}}
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Số điện thoại:</label>
                    <input type="text" name="shipping_phone" class="form-control" placeholder="Số điện thoại">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Ghi chú:</label>
                    <textarea type="email" name="shipping_note" class="form-control" placeholder="Ghi chú" rows="5"></textarea>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12" style="justify-content: center; display: flex;">
                        <input class="form-check-input" type="radio" style="margin: 5px" name="payment_option" id="gridRadios1" value="pay_by_ATM" disabled>
                        <label class="form-check-label" for="gridRadios1" style="margin: 5px">Thanh toán qua thẻ</label>

                        <input class="form-check-input" type="radio" style="margin: 5px" name="payment_option" id="gridRadios2" value="pay_by_cash" checked>
                        <label class="form-check-label" for="gridRadios2" style="margin: 5px">Trả tiền mặt</label>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    <input type="hidden" name="total" value="{{$total - $total_promote + 30000}}">
                    <input type="hidden" name="total_promote" value="{{$total_promote}}">
                    <button type="submit" class="btn btn-success">Đặt hàng</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
{{-------------------------------------------------------------}}
</section>
@endsection
