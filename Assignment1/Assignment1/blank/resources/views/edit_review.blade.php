<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('layouts.navbar')

    <div class="container mt-5">
        <h1>Edit Review for Movie: {{ $review->movie->title }}</h1>
        <form action="{{ url('update_review/' . $review->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="author" class="form-label">Name:</label>
                <input type="text" class="form-control" name="author" value="{{ old('author', $review->author) }}" required>
                @if ($errors->has('author'))
                    <span class="text-danger">{{ $errors->first('author') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">Rating:</label>
                <input type="number" class="form-control" name="rating" min="1" max="5" value="{{ old('rating', $review->rating) }}" required>
            </div>

            <div class="mb-3">
                <label for="review_text" class="form-label">Review:</label>
                <textarea class="form-control" name="review_text" rows="4">{{ old('review_text', $review->review_text) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Review</button>
        </form>
    </div>
</body>
</html>
