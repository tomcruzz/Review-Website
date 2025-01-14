<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('layouts.navbar')

    <div class="container mt-5">
        @if(session('name_changed'))
            <div class="alert alert-warning">
                {{ session('name_changed') }}
            </div>
        @endif
        
        <!-- Movie Details -->
        <div class="row">
            <div class="movie-text">
                <h1>{{ $movie->title }}</h1>
                <img src="{{ asset('assets/images/movies/movie' . $movie->id . '.jpg') }}" 
                             alt="Movie poster for {{ $movie->title }}" 
                             style="height: 320px; border-radius: 30px 30px 0 0;">
                <p>{{ $movie->description }}</p>
                <p>Director: {{ $movie->director }}</p>
                <p>Release Year: {{ $movie->release_year }}</p>
                <p>Genre: {{ $movie->genre }}</p>
            </div>
        </div>

        <!-- Add Review Button -->
        <div class="row mt-4">
            <a href="{{ url('/add_review/' . $movie->id) }}" class="btn btn-primary">Add Review</a>
            <!-- <a href="/add_review/{{ $movie->id }}" class="btn btn-primary">Add Review</a> -->
        </div>

        <!-- Rating -->
        <div class="row mt-4">
            <div class="rating">
                <h3>Rating</h3>
                @php
                    $totalRating = 0;
                    $reviewCount = count($reviews);
                    foreach ($reviews as $review) {
                        $totalRating += $review->rating;
                    }
                    $averageRating = $reviewCount > 0 ? $totalRating / $reviewCount : 0;
                @endphp
                <h3>{{ number_format($averageRating, 1) }}/5</h3>
            </div>
        </div>

        <!-- User Reviews -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h2>User Reviews ({{ $reviewCount }})</h2>
                <div id="reviewsContainer">
                    @foreach ($reviews as $review)
                        <div class="card-review mb-3">
                            <div class="card-body-review">
                                <h5 class="card-title-review">{{ $review->author }} - Rating: {{ $review->rating }}/5</h5>
                                <p class="card-text-review">{{ $review->review_text }}</p>
                                <small>Reviewed on: {{ \Carbon\Carbon::parse($review->created_at)->format('M d, Y') }}</small>
                                <form action="{{ url("delete_review/$review->id") }}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">Delete review</button>
                                    <a href="{{ url("edit_review/$review->id") }}" class="btn btn-primary">Edit</a>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
