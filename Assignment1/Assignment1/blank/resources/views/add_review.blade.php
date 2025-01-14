<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .error { color: red; }
        .info { color: blue; }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container mt-5">
        <h1>Add Review for {{ $movie->title }}</h1>
        <img src="{{ asset('assets/images/movies/movie' . $movie->id . '.jpg') }}" 
             alt="Movie poster for {{ $movie->title }}" 
             style="height: 320px; border-radius: 30px 30px 0 0;">

        <form id="reviewForm" action="{{ url('add_review/' . $movie->id) }}" method="POST">
            {{ csrf_field() }}

            <div class="mb-3">
                <label for="author" class="form-label">Name:</label><br>
                <input type="text" id="author" class="form-control" name="author" placeholder="Enter your name" required>
                @if ($errors->has('author'))
                    <span class="text-danger">{{ $errors->first('author') }}</span>
                @endif
                <span id="authorError" class="error"></span>
                <span id="authorInfo" class="info"></span>
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">Rating:</label><br>
                <input type="number" id="rating" class="form-control" name="rating" min="1" max="5" required>
                <span id="ratingError" class="error"></span>
            </div>

            <div class="mb-3">
                <label for="review_text" class="form-label">Review:</label><br>
                <textarea id="review_text" class="form-control" name="review_text" rows="4" placeholder="Write your review here" required></textarea>
                <span id="reviewTextError" class="error"></span>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('reviewForm').addEventListener('submit', function(event) {
            let isValid = true;

            // Clear previous errors
            document.getElementById('authorError').textContent = '';
            document.getElementById('ratingError').textContent = '';
            document.getElementById('reviewTextError').textContent = '';
            document.getElementById('authorInfo').textContent = '';

            // Validate author name
            let author = document.getElementById('author').value.trim();
            const authorRegex = /^[a-zA-Z0-9\s]+$/; // Allow only letters, numbers, and spaces
            let originalAuthor = author;

            // Remove odd numbers from the username
            author = author.replace(/[13579]/g, '');

            if (author.length <= 2) {
                document.getElementById('authorError').textContent = 'Name must have more than 2 characters.';
                isValid = false;
            } else if (!authorRegex.test(author)) {
                document.getElementById('authorError').textContent = 'Name cannot contain symbols like -, _, +, or ".';
                isValid = false;
            }

            if (originalAuthor !== author) {
                document.getElementById('authorInfo').textContent = `Note: The name "${originalAuthor}" has been modified to "${author}".`;
            }

            // Validate rating
            const rating = document.getElementById('rating').value;
            if (rating < 1 || rating > 5 || isNaN(rating)) {
                document.getElementById('ratingError').textContent = 'Rating must be a number between 1 and 5.';
                isValid = false;
            }

            // Validate review text
            const reviewText = document.getElementById('review_text').value.trim();
            const wordCount = reviewText.split(/\s+/).length;
            if (wordCount < 3) {
                document.getElementById('reviewTextError').textContent = 'Review text must have a minimum of 3 words.';
                isValid = false;
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            } else {
                // Set the modified author name back to the input field
                document.getElementById('author').value = author;
            }
        });
    </script>
</body>
</html>
