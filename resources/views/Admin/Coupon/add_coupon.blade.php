 @extends('admin_layout')
 @section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            ADD COUPON
                        </header>
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo "<p align='center'> <font color=green size='2px'> $message </font></p>";
                                Session::forget('message');
                            }
	                    ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form action="{{URL::to('save-coupon')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="nameCoupon">NAME</label>
                                    <input type="text" class="form-control" minlength="2" maxlength="20" name="name_coupon" id="nameCoupon"  required>
                                </div>
                                <div class="form-group">
                                    <label for="codeCoupon">CODE</label>
                                    <input type="text" class="form-control" minlength="2" maxlength="20" name="code_coupon" id="codeCoupon" required>
                                </div>
                                <div class="form-group">
                                    <label for="qtyCoupon">QUANTITY</label>
                                    <input type="number" class="form-control" name="qty_coupon" id="qtyCoupon"  required>
                                </div>
                                <div class="form-group">
                                    <label for="maxpromoteCoupon">MAXIMUM PROMOTE OF CART VALUE</label>
                                    <input type="number" class="form-control" name="max_promote_coupon" id="maxpromoteCoupon"  required>
                                </div>
                                <div class="form-group">
                                <label for="selector">MODE</label>
                                    <select name="mode_coupon" class="form-control m-bot15" id="selector">
                                        <option>-----Select------</option>
                                        <option value="0" >Percent</option>
                                        <option value="1" >Cash</option>
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="valueCoupon">CASH OR % VALUE</label>
                                    <input type="number" class="form-control" name="value_coupon" id="valueCoupon" placeholder="Enter value" required>
                                </div>
                                <button type="submit" name="submit_add_coupon" class="btn btn-primary btn-lg btn-block">ADD</button>
                            </form>
                            </div>

                        </div>
                    </section>
            </div>
@endsection