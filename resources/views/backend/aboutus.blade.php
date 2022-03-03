<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>About Us</title>
    
</head>
<div class="container">
   <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add About Data
    </button>
    <a href="{{ url('dashboard') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>Back</a>
    <div id="success_message"></div>
</div>
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
    
    <form enctype="multipart/form-data" id="inputData">
        @csrf
        <div class="modal-body">
            <div class="alert alert-danger d-none" id="save_errorList">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="Enter your Email">
            </div>

            <div class="form-group">
                <label>Contact</label>
                <input type="text" name="contact" class="form-control" placeholder="Your Phone number">
            </div>

            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" placeholder="Type your description here">
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

<div class="container">
<tr>
        <table class="table table table-bordered">
            <tr>
                <th scope="col">S.no</th>
                <th scope="col">Email</th>
                <th scope="col">Contact</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>   
            @foreach($data as $key=>$val)
                <tr>
                    <td>
                        {{$key+1}}
                    </td>
                    <td>
                        {{$val->email}}
                    </td>
                    <td>
                        {{$val->contact}}
                    </td>
                    <td>
                        {{$val->description}}
                    </td>

                    <td>
                        <img src="{{asset('/about/'.$val->image)}}" width="50px">
                    </td>

                    <td>
                        <a href="#" class="btn btn-primary btn-sm">view</a>
                        <a href="#" class="btn btn-secondary btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </tr>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" 
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
 integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
 crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" 
  crossorigin="anonymous">
</script>
<script>
    $(document).ready(function(){
       $('#inputData').on('submit', function(e){
           console.log('clicked');
           e.preventDefault();
            let data = new FormData($('#inputData')[0]);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: "POST",
                url: "/aboutus",
                data: data,
                dataType:"json",
                contentType:false,
                processData:false,
                success: function (response){
                    if(response.status == 400){

                        $('#saveform_err').html("");
                        $('#save_errorList').removeClass("d-none");
                        
                        $.each(response.errors,function(key,err_values){
                            $('#save_errorList').append('<li>'+err_values+'</li>');
                        });
                    }
                    else{
                        $('#saveform_errList').html("");
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
