<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Service-add</title>
    
</head>
<body>  
    <div class="container">  
<form action="{{route('service-add.store')}}" method="post">
    @csrf

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="col-xs-6">
        <label class="alert alert-primary">Service NAME</label>
        <input type="text" name="name" placeholder="Input your Skill Name" class="form-control">
        @error('name')
        <p>{{ $message }}</p>
        @enderror
    </div>

    <div class="col-xs-6">
        <label class="alert alert-primary">Service Description</label>
         <textarea class="form-control" name="description" rows="5" cols="20"></textarea>
        @error('description')
        <p>{{ $message }}</p>
        @enderror
    </div>

    <div class="col-xs-6">
        <label class="alert alert-primary">Service Icon</label>
        <input type="text" name="icon" placeholder="Service icon" class="form-control">
        @error('icon')
        <p>{{ $message }}</p>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="is_active" class="alert alert-primary">
            Status:-
        </label>
        <div class="form-check">
            <input type="radio" class="form-check-input"
            name="is_active" id="status" value="active">
            <label for="status" class="form-check-label">
                Active
            </label>
        </div>

        <div class="form-check">
            <input type="radio" class="form-check-input alert alert-success"
            name="is_active" id="status" value="in-active">
            <label for="status" class="form-check-label">
                In-Active
            </label>
        </div>
        @error('is_active')
        <p>{{$message}}</p>
        @enderror
    </div>
    <br>
    <input type="submit" name="submit" class="btn btn-primary btn-m" value="insert">
    <a href="{{ url('service')}}" class="btn btn-primary btn-m">Back</a>
</form>
</div>
</body>
</html>
