<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">    
</head>
<body>  
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 Add Data
</button>
<a href="{{ url('dashboard') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>Back</a>
 <div id="success_message"></div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Home Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   
    <form enctype="multipart/form-data" id="formData" method="POST" action="{{route('home')}}">
        @csrf
        <div class="modal-body">
            <ul class="alert alert-danger d-none" id="save_errorList">

            </ul>
              <div>
                <ul id="save_errList"></ul>
              </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Full Name">
                </div>

                <div class="form-group">
                    <label>Post</label>
                    <input type="text" name="post" class="form-control" placeholder="Your Post">
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" placeholder="Image">
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary add_data">Save</button>
        </div>
    </form>
    </div>
    </div>
  </div>
</div>
    <tr>
        <table class="table table table-bordered">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Post</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>   
            @foreach($site_data as $data)
                <tr>
                    <td>
                        {{$data->name}}
                    </td>

                    <td>
                        {{$data->post}}
                    </td>

                    <td>
                        <img src="{{asset('/images/'.$data->image)}}" width="50px">
                    </td>

                    <td>
                        <a href="#" class="btn btn-primary btn-sm">view</a>
                        <a href="{{route('backend.edit',$data->id)}}" class="btn btn-secondary btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </tr>
    <script src="https://code.jquery.com/jquery-3.6.0.js" 
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
       $(document).on('submit','#formData', function(e){
           e.preventDefault();
        // var data = {
        //     'name': $('.name').val(),
        //     'post': $('.post').val(),
        //     'image': $('.image').val(),
        // }
        // console.log(data);
        let data = new FormData($('#formData')[0]);
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: "POST",
            url: "/home",
            data: data,
            dataType:"json",
            contentType:false,
            // cache:false;
            processData:false,
            success: function (response){
                // console.log(response);
                if(response.status == 400){

                    $('#save_errList').html("");
                    $('#save_errList').removeClass('d-none');
                    
                    $.each(response.errors,function(key,err_values){
                        $('#save_errList').append('<li>'+err_values+'</li>');
                    });
                }
                else{
                    $('#save_errList').html("");
                    $('#success_message').text(response.message);
                    $('#success_message').addClass('alert alert-success');
                    $('#exampleModal').modal('hide');
                    $('#exampleModal').find('input').val("");
                    location.reload();
                }
            }
        
        });
       });
    });
</script>
</body>
</html>
