 @extends('admin_layout')
 @section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            ADD CATEGORY
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
                                <form action="{{URL::to('save-category')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="nameCategory">NAME</label>
                                    <input type="text" class="form-control" name="name_category" id="nameCategory" placeholder="Enter Category">
                                </div>
                                <div class="form-group">
                                    <label for="descriptionCategory">DESCRIPTION</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="description_category" id="descriptionCategory" maxlength="200" minlength="4" pattern="^[a-zA-Z0-9_.-]*$" required></textarea>
                                </div>
                                <div class="form-group">
                                <label for="selector">MODE</label>
                                    <select name="status_category" class="form-control m-bot15" id="selector">
                                        <option value="0" >Hide</option>
                                        <option value="1" >Show</option>
                                    </select>
                                </div>
                                <button type="submit" name="submit_add_category" class="btn btn-primary btn-lg btn-block">ADD</button>
                            </form>
                            </div>

                        </div>
                    </section>
            </div>
@endsection