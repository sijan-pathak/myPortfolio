<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Portfolio-add</title>
    
</head>
<body> 
<div class="container col-md-6">   
    <form action="{{route('backend.skill-add.store')}}" method="post">
        @csrf

        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        <div class="col-xs-6">
            <label>PROJECT NAME</label>
            <input type="text" name="name" placeholder="Project Name" class="form-control">
            @error('name')
            <p>{{ $message }}</p>
            @enderror
        </div><br>
        <div class="col-xs-6">
            <label>DATE</label>
            <input type="date" name="date" id="date">
            @error('date')
            <p>{{ $message }}</p>
            @enderror
        </div><br>
        <div class="col-xs-6">
            <label>COVER IMAGE</label><br>
            <input type="file" name="image">
            @error('image')
            <p>{{ $message }}</p>
            @enderror
        </div><br>
        
        <input type="submit" name="submit" class="btn btn-primary btn-sm" value="insert">
        <a href="{{ url('portfolio')}}" class="btn btn-primary btn-sm">Back</a>
    </form>
</div>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        $('.date').datepicker();        
    });
</script>
</body>
</html>
