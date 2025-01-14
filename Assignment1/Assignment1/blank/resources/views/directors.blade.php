<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directors</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    @include('layouts.navbar')

    <div class="container mt-5">
        <h1>Directors Collection</h1>

        <div class="row mt-4">
            @foreach ($directors as $director)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <!-- Director Image (if available) -->
                        
                        <div class="card-body">
                            <h3 class="director">
                                <a class="view-movies" href="/directors/{{ urlencode($director->director) }}/movies">
                                    {{ $director->director }}
                                </a>
                            </h3>
                            <p><strong>Movies Directed:</strong> {{ $director->movieCount }}</p>
                            <a href="{{ url('directors/' . urlencode($director->director) . '/movies') }}" class="btn btn-secondary">View Movies</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
