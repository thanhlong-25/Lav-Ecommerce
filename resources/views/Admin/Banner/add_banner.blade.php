 @extends('admin_layout')
 @section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            ADD BANNER
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
                                <form action="{{URL::to('save-banner')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="nameBanner">NAME</label>
                                    <input type="text" class="form-control" minlength="2" maxlength="50" name="name_banner" id="nameBanner" required>
                                </div>
                                <div class="form-group">
                                    <label for="imageBanner">IMAGE</label>
                                    <input type="file" class="form-control" name="image_banner" id="imageBanner" required>
                                </div>
                                <div class="form-group">
                                <label for="selector">MODE</label>
                                    <select name="status_banner" class="form-control m-bot15" id="selector">
                                        <option value="1" >Show</option>
                                        <option value="0" >Hide</option>
                                    </select>
                                </div>
                                <button type="submit" name="submit_add_Banner" class="btn btn-primary btn-lg btn-block">ADD</button>
                            </form>
                            </div>

                        </div>
                    </section>
            </div>
@endsection