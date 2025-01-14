<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $director }} Movies</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Display all movies specific to the particular director -->
    <div class="container mt-5">
        <h1>{{ $director }} Collection</h1>
            <div class="row mt-4">
                @foreach ($movies as $movie)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                        <img src="{{ asset('assets/images/movies/movie' . $movie->id . '.jpg') }}" 
                             alt="Movie poster for {{ $movie->title }}" 
                             style="height: 320px; border-radius: 30px 30px 0 0;">

                            <!-- Movie Details -->
                            <div class="card-body">
                                <h5 class="card-title">{{ $movie->title }}</h5>
                                <p><strong>Rating:</strong> {{ number_format($movie->averageRating, 1) }}/5 ({{ $movie->reviewCount }} reviews)</p>
                                <p class="card-text">{{ Str::limit($movie->description, 150, '...') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
</body>
</html>
