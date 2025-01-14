<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mollywood Movies</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('layouts.navbar')

    <div class="container mt-5">
        <div class="row">
            <div>
                <h1 class="text-start">Find out the best-rated Malayalam movies!</h1>
                <p class="text-start">Movies:</p>
            </div>
        </div>

        <!-- Sort Section -->
        <div class="row mt-3">
            <form method="GET" action="{{ url('/') }}" class="form-inline">
                <label for="sort" class="mr-2">Sort by:</label>
                <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title</option>
                    <option value="review_count" {{ request('sort') == 'review_count' ? 'selected' : '' }}>Number of Reviews</option>
                    <option value="average_rating" {{ request('sort') == 'average_rating' ? 'selected' : '' }}>Average Rating</option>
                </select>
            </form>
        </div>

        <!-- Movies section -->
        <div class="row mt-4">
            @foreach ($movies as $movie)
                <div class="row">
                    <div class="card">
                        
                    <img src="{{ asset('assets/images/movies/movie' . $movie->id . '.jpg') }}" 
                             alt="Movie poster for {{ $movie->title }}" 
                             style="height: 320px; border-radius: 30px 30px 0 0;">
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p><strong>Rating:</strong> {{ number_format($movie->averageRating, 1) }}/5 ({{ $movie->reviewCount }} reviews)</p>
                            <p class="card-text">{{ $movie->description }}</p>
                            <div class="row-display">
                                <a href="{{ url('movie/' . $movie->id) }}" class="btn btn-secondary">More</a>
                                <!-- <a href="{{ url('add_review/' . $movie->id) }}" class="btn btn-secondary">More</a> -->
                                <form action="{{ url("delete_movie/$movie->id") }}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger delete">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Movie Button -->
        <a href="{{ url('add_movie') }}" class="btn btn-primary add-movie">Add Movie</a>
    </div>
</body>
</html>
