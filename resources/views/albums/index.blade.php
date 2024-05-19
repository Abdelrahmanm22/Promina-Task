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
    <h1>Album List</h1>

    <a href="{{ route('album.store') }}" class="btn btn-primary">Add New Album</a>

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Album Name</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($albums as $album)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $album->name }}</td>
                <td>
                    <a href="{{ url('album/edit/' . $album->id) }}" class="btn btn-warning">Edit</a>
                    @if($album->pictures->count() == 0)
                        <form method="post" action="{{ route('album.delete', $album->id) }}" style="display:inline-block;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @else
                        <button type="button" class="btn btn-danger" onclick="showModal({{ $album->id }}, '{{ $album->name }}')">Delete</button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Album</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>The album <span id="albumName"></span> contains pictures. What would you like to do?</p>
                <form id="deleteForm" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete All Pictures</button>
                </form>
                <form id="moveForm" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="target_album_id" class="form-label">Move to Album</label>
                        <select class="form-select" id="target_album_id" name="target_album_id" required>

                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning">Move Pictures</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    const albums = @json($albums);

    function showModal(albumId, albumName) {
        document.getElementById('albumName').textContent = albumName;
        document.getElementById('deleteForm').action = '/album/delete-all-pictures/' + albumId;
        document.getElementById('moveForm').action = '/album/move-pictures/' + albumId;


        const select = document.getElementById('target_album_id');
        select.innerHTML = '';
        albums.forEach(album => {
            if (album.id !== albumId) {
                const option = document.createElement('option');
                option.value = album.id;
                option.textContent = album.name;
                select.appendChild(option);
            }
        });

        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
