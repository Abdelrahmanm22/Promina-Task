<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <h1>Add New Album</h1>
    <form method="post" action="{{route('album.create')}}" enctype="multipart/form-data" >
        @csrf
        <div class="row">
            <div class="col-sm-8">
                <!-- text input -->
                <div class="form-group">
                    <label>* Name of Book </label>
                    <input type="text" name="name" class="form-control" value=""
                           placeholder="Enter ...">
                    @error('name')
                    <small class="form-txt text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <!-- file input -->
                <div class="form-group">
                    <label>* Upload Pictures (you can upload multiple picture)</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                    @error('images')
                    <small class="form-txt text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Add Album</button>

    </form>

</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>
