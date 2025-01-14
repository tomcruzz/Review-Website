<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Movie</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('layouts.navbar')

    <div class="container mt-5">
        <form action="{{ url('add_movie') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="mb-3">
                <label for="title" class="form-label">Movie Title:</label><br>
                <input type="text" class="form-control" name="title" placeholder="Enter movie title" required>
                @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="director" class="form-label">Director:</label><br>
                <input type="text" class="form-control" name="director" placeholder="Enter director name" required>
                @if ($errors->has('director'))
                    <span class="text-danger">{{ $errors->first('director') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="release_year" class="form-label">Release Year:</label><br>
                <input type="text" class="form-control" name="release_year" placeholder="Enter release year" required>
                @if ($errors->has('release_year'))
                    <span class="text-danger">{{ $errors->first('release_year') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Genre:</label><br>
                <input type="text" class="form-control" name="genre" placeholder="Enter genre" required>
                @if ($errors->has('genre'))
                    <span class="text-danger">{{ $errors->first('genre') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label><br>
                <textarea class="form-control" name="description" rows="4" placeholder="Write movie description here" required></textarea>
                @if ($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="poster" class="form-label">Movie Poster:</label><br>
                <input type="file" class="form-control" name="poster" required>
                @if ($errors->has('poster'))
                    <span class="text-danger">{{ $errors->first('poster') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
