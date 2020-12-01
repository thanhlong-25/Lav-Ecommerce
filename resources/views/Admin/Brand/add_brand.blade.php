 @extends('admin_layout')
 @section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            ADD BRAND
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
                                <form action="{{URL::to('save-brand')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="nameBrand">NAME</label>
                                    <input type="text" class="form-control" minlength="2" maxlength="20" name="name_brand" id="nameBrand" placeholder="Enter brand" required>
                                </div>
                                <div class="form-group">
                                    <label for="descriptionBrand">DESCRIPTION</label>
                                    <textarea style="resize: none" rows="8" class="form-control" minlength="2" maxlength="20" name="description_brand" id="descriptionBrand" required></textarea>
                                </div>
                                <div class="form-group">
                                <label for="selector">MODE</label>
                                    <select name="status_brand" class="form-control m-bot15" id="selector">
                                        <option value="0" >Hide</option>
                                        <option value="1" >Show</option>
                                    </select>
                                </div>
                                <button type="submit" name="submit_add_brand" class="btn btn-primary btn-lg btn-block">ADD</button>
                            </form>
                            </div>

                        </div>
                    </section>
            </div>
@endsection