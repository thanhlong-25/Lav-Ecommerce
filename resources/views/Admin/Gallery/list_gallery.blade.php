 @extends('admin_layout')
 @section('admin_content')
<input type="hidden" value="{{$pro_id}}" name="pro_id" id="pro_id">
<button style="margin: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus" aria-hidden="true"></i>   Addition</button>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{URL::to('add-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLongTitle">Addition Product</h2>
                </div>
                <div class="modal-body">
                                <div class="form-group">
                                    <label for="nameproduct">CHOOSE IMAGE</label>
                                    <input type="file" class="form-control" id="list_file" name="list_file[]" accept="image/*" multiple>
                                    <span id="error_gallery"></span> 
                                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="load_gallery"></div>

<script type="text/javascript">
  $(document).ready(function(){
      load_gallery();
      
      function load_gallery(){
        var pro_id = $('#pro_id').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
          url: '{{url('/load-gallery')}}',
          method: 'POST',
          data:{
              pro_id:pro_id, 
              _token:_token},
            success:function(data){
              $('#load_gallery').html(data);
    			  }	
          });
        }
// CHECK FILE GALLERY UPLOAD************************************************************************************************
        $("#list_file").change(function(){
          var error = '';
          var files = $('#list_file')[0].files;

          if(files.length > 4){
            error += '<p>Maximun 4 images</p>';
          }else if(files.length == ''){
            error += '<p>Must not be blank</p>';
          }else if(files.size > 10000){
            error += '<p>File too large, maximum 10MB</p>';
          }
          if(error == ''){
          }else{
            $('#list_file').val('');
            $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
            return false;
          }
        });


// Xoá ảnh
        $(document).on('click', '#delete_gallery', function(){
          var gallery_id = $(this).data('gallery_id');
          var _token = $('input[name="_token"]').val();
           
           swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this imaginary file!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if(willDelete) {
                 $.ajax({
                    url: '{{URL('/delete-gallery')}}',
                    method: 'POST',
                    data:{
                        gallery_id:gallery_id, 
                        _token:_token},
                      success:function(data){
                        load_gallery();
                        swal("Deleted!", "The image has been deleted!", "error");
                      }	
                    });
              } else {
              }
            });
        })

//Update ảnh
        $(document).on('change', '.edit_gallery', function(){ 
          var gallery_id = $(this).data('gallery_id');
          var image = document.getElementById('edit_gallery_' + gallery_id).files[0];

          var form_data = new FormData();
          form_data.append("image_file", document.getElementById('edit_gallery_' + gallery_id).files[0]);
          form_data.append("gallery_id", gallery_id);
          
                 $.ajax({
                    url: '{{URL('/update-gallery')}}',
                    method: 'POST',
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                      success:function(data){
                        load_gallery();
                        swal("Updated!", "The image has been updated!", "success");
                        }	
                    });
            });
  });
</script>
@endsection
