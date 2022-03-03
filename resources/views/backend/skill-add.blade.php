<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
    
</head>
<body>    
<form action="{{route('backend.skill-add.store')}}" method="post">
    @csrf

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="col-xs-6">
        <label>NAME</label>
        <input type="text" name="name" placeholder="Input your Skill Name" class="form-control">
        @error('name')
        <p>{{ $message }}</p>
        @enderror
    </div>
    <div class="col-xs-6">
        <label>Data</label>
        <input type="text" name="data" placeholder="Input your skill level" class="form-control">
        @error('data')
        <p>{{ $message }}</p>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="is_active">
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
            <input type="radio" class="form-check-input"
            name="is_active" id="status" value="in-active">
            <label for="status" class="form-check-label">
                In-Active
            </label>
        </div>
        @error('is_active')
        <p>{{$message}}</p>
        @enderror
    </div>
    <input type="submit" name="submit" class="btn btn-primary btn-sm" value="insert">
    <a href="{{ url('skills')}}" class="btn btn-primary btn-sm">Back</a>
</form>

</body>
</html>
