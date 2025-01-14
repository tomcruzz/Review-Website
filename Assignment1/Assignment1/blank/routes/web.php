<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home route - displays all movies and their reviews
Route::get('/', function () {
    $sort = request()->input('sort', 'title');
    $movies = DB::table('movies')->get();

    foreach ($movies as $movie) {
        $movie->reviews = get_reviews($movie->id);
        $totalRating = 0;
        $reviewCount = count($movie->reviews);
        foreach ($movie->reviews as $review) {
            $totalRating += $review->rating;
        }
        $movie->averageRating = $reviewCount > 0 ? $totalRating / $reviewCount : 0;
        $movie->reviewCount = $reviewCount;
        $movie->randomImage = get_random_movie_image();
    }

    if ($sort === 'review_count') {
        $movies = $movies->sortByDesc('reviewCount');
    } elseif ($sort === 'average_rating') {
        $movies = $movies->sortByDesc('averageRating');
    }

    return view('home')->with('movies', $movies);
});

// Route to display a single movie and its reviews
Route::get('/movie/{id}', function ($id) {
    $movie = get_details($id);
    $reviews = get_reviews($id);

    return view('movie', [
        'movie' => $movie,
        'reviews' => $reviews
    ]);
});

// Route to display all directors
Route::get('/directors', function () {
    // Fetch distinct directors, along with the number of movies they directed and the average rating
    $directors = DB::table('movies')
        ->select('director', DB::raw('COUNT(*) as movieCount'))
        ->groupBy('director')
        ->get();
    return view('directors')->with('directors', $directors);
});

// Route to show all movies by a specific director
Route::get('/directors/{director}/movies', function ($director) {
    // Fetch all movies by the specific director
    $movies = DB::table('movies')
        ->where('director', $director)
        ->get();

    // Calculate average rating and review count for each movie
    foreach ($movies as $movie) {
        $reviews = DB::table('reviews')->where('movie_id', $movie->id)->get();
        $totalRating = $reviews->sum('rating');
        $reviewCount = $reviews->count();
        $movie->averageRating = $reviewCount > 0 ? $totalRating / $reviewCount : 0;
        $movie->reviewCount = $reviewCount;
        $movie->randomImage = get_random_movie_image(); // Assuming this is a function that gets a random movie image
    }

    // Return the director view with the fetched movies and director name
    return view('director', ['movies' => $movies, 'director' => $director]);
});


// Route to add a new movie (GET method to show the form)
Route::get('/add_movie', function () {
    return view('add_movie');
});

// Route to save the new movie with poster upload (POST method)
Route::post('/add_movie', function (Request $request) {
    $title = $request->input('title');
    $director = $request->input('director');
    $release_year = $request->input('release_year');
    $genre = $request->input('genre');
    $description = $request->input('description');

    $poster = null;
    if ($request->hasFile('poster')) {
        $poster = $request->file('poster')->store('movies', 'public');
    }

    DB::insert('INSERT INTO movies (title, director, release_year, genre, description, poster) VALUES (?, ?, ?, ?, ?, ?)', 
                [$title, $director, $release_year, $genre, $description, $poster]);

    return redirect('/');
});


// movie 
Route::get('/movie/{id}', function ($id) {
    $product = get_details($id);
    $reviews = get_reviews($id);
    return view('movie')->with('movie', $product)->with('reviews', $reviews);
});


// Edit review
Route::get('edit_review/{id}', function($id) {
    $review = get_review_by_id($id); // Fetch the review data
    return view('edit_review')->with('review', $review);
});

// Update review when the form is submitted
Route::post('update_review/{id}', function($id){
    $validatedData = request()->validate([
        'author' => ['required', 'min:3', 'regex:/^[a-zA-Z0-9\s]+$/'],
        'rating' => ['required', 'integer', 'between:1,5'],
        'review_text' => ['nullable'],
    ], [
        'author.required' => 'The author name is required.',
        'author.min' => 'The author name must be more than 2 characters.',
        'author.regex' => 'The author name cannot contain symbols like -, _, +, or .',
        'rating.required' => 'The rating is required.',
        'rating.between' => 'The rating must be between 1 and 5.',
    ]);
    $updated = update_review($id, $validatedData['author'], $validatedData['rating'], $validatedData['review_text']);
    
    if ($updated) {
        return redirect(url("product/$id"));
    } else {
        return back()->withErrors(['msg' => 'Error while updating review.']);
    }
});


// Route to delete a movie and its reviews
Route::post('/delete_movie/{id}', function ($id) {
    $movie = DB::table('movies')->where('id', $id)->first();

    if ($movie && !empty($movie->poster)) {
        Storage::disk('public')->delete($movie->poster);
    }

    DB::table('movies')->where('id', $id)->delete();
    DB::table('reviews')->where('movie_id', $id)->delete();

    return redirect('/');
});

// Route to delete a review
Route::post('/delete_review/{id}', function ($id) {
    delete_review($id);
    return redirect()->back();
});

// Helper functions
function get_details($id) {
    $movie = DB::table('movies')->where('id', $id)->first();
    if (!$movie) {
        abort(404, 'Movie not found');
    }
    return $movie;
}

function get_reviews($movie_id) {
    return DB::table('reviews')->where('movie_id', $movie_id)->get();
}

function add_review($movie_id, $author, $rating, $review_text) {
    DB::table('reviews')->insert([
        'movie_id' => $movie_id,
        'author' => $author,
        'rating' => $rating,
        'review_text' => $review_text,
    ]);
}

function delete_review($id) {
    DB::table('reviews')->where('id', $id)->delete();
}

function calculate_average_rating($reviews) {
    if ($reviews->isEmpty()) {
        return 0;
    }

    $totalRating = $reviews->sum('rating');
    return $totalRating / $reviews->count();
}

function get_random_movie_image() {
    $images = glob(public_path('assets/images/movies/') . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    return basename($images[array_rand($images)]);
}

// Route to display a single movie and its reviews
Route::get('/movie/{id}', function ($id) {
    $movie = get_details($id);
    $reviews = get_reviews($id);

    return view('movie', [
        'movie' => $movie,
        'reviews' => $reviews
    ]);
});



Route::get('/directors/{director}/movies', function ($encodedDirector) {
    $director = urldecode($encodedDirector);

    // Fetch movies for the decoded director name
    $movies = DB::table('movies')->where('director', $director)->get();

    // Add review and rating data
    foreach ($movies as $movie) {
        $reviews = DB::table('reviews')->where('movie_id', $movie->id)->get();
        $totalRating = $reviews->sum('rating');
        $reviewCount = $reviews->count();
        $movie->averageRating = $reviewCount > 0 ? $totalRating / $reviewCount : 0;
        $movie->reviewCount = $reviewCount;
    }

    return view('director', ['movies' => $movies, 'director' => $director]);
});


// Route to show the Add Review page
Route::get('/add_review/{movie_id}', function ($movie_id) {
    $movie = get_details($movie_id);
    return view('add_review')->with('movie', $movie);
});

// Route to handle the POST request for adding a review
Route::post('/add_review/{movie_id}', function (Request $request, $movie_id) {
    // Retrieve the author's name from the session if it exists
    $author = $request->session()->get('author', $request->input('author'));

    // Validate input
    $validatedData = $request->validate([
        'rating' => ['required', 'integer', 'between:1,5'],
        'review_text' => ['nullable'],
    ]);

    // Save the review to the database
    DB::table('reviews')->insert([
        'movie_id' => $movie_id,
        'author' => $author,
        'rating' => $validatedData['rating'],
        'review_text' => $validatedData['review_text'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Store the author's name in the session for future use
    $request->session()->put('author', $author);

    return redirect('/movie/' . $movie_id); // Redirect back to the movie details page
});


// Helper function to get a review by its ID
function get_review_by_id($id) {
    $review = DB::table('reviews')->where('id', $id)->first();
    if (!$review) {
        abort(404, 'Review not found');
    }
    // Optionally, include related movie data if needed
    $review->movie = DB::table('movies')->where('id', $review->movie_id)->first();
    return $review;
}

// Route to update the review when the form is submitted
Route::post('/update_review/{id}', function ($id) {
    $validatedData = request()->validate([
        'author' => ['required', 'min:3', 'regex:/^[a-zA-Z0-9\s]+$/'],
        'rating' => ['required', 'integer', 'between:1,5'],
        'review_text' => ['nullable'],
    ], [
        'author.required' => 'The author name is required.',
        'author.min' => 'The author name must be more than 2 characters.',
        'author.regex' => 'The author name cannot contain symbols like -, _, +, or .',
        'rating.required' => 'The rating is required.',
        'rating.between' => 'The rating must be between 1 and 5.',
    ]);

    $updated = update_review($id, $validatedData['author'], $validatedData['rating'], $validatedData['review_text']);

    if ($updated) {
        return redirect('/movie/' . $movie_id); // Redirect back to the movie details page
    } else {
        return back()->withErrors(['msg' => 'Error while updating review.']);
    }
});


// Route to show the Edit Review page
Route::get('/edit_review/{id}', function ($id) {
    $review = get_review_by_id($id); // Fetch the review data
    return view('edit_review')->with('review', $review);
});

// Route to update the review when the form is submitted
Route::post('/update_review/{id}', function ($id) {
    $validatedData = request()->validate([
        'author' => ['required', 'min:3', 'regex:/^[a-zA-Z0-9\s]+$/'],
        'rating' => ['required', 'integer', 'between:1,5'],
        'review_text' => ['nullable'],
    ], [
        'author.required' => 'The author name is required.',
        'author.min' => 'The author name must be more than 2 characters.',
        'author.regex' => 'The author name cannot contain symbols like -, _, +, or .',
        'rating.required' => 'The rating is required.',
        'rating.between' => 'The rating must be between 1 and 5.',
    ]);

    $updated = update_review($id, $validatedData['author'], $validatedData['rating'], $validatedData['review_text']);

    if ($updated) {
        return redirect('/movie/' . $id); // Redirect back to the movie details page
    } else {
        return back()->withErrors(['msg' => 'Error while updating review.']);
    }
});


function update_review($id, $author, $rating, $review_text) {
    return DB::table('reviews')
        ->where('id', $id)
        ->update([
            'author' => $author,
            'rating' => $rating,
            'review_text' => $review_text,
            'updated_at' => now(),
        ]);
}


