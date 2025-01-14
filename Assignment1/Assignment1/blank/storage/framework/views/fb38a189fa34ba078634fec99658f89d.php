<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($movie->title); ?></title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
    <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mt-5">
        <?php if(session('name_changed')): ?>
            <div class="alert alert-warning">
                <?php echo e(session('name_changed')); ?>

            </div>
        <?php endif; ?>
        
        <!-- Movie Details -->
        <div class="row">
            <div class="movie-text">
                <h1><?php echo e($movie->title); ?></h1>
                <img src="<?php echo e(asset('assets/images/movies/movie' . $movie->id . '.jpg')); ?>" 
                             alt="Movie poster for <?php echo e($movie->title); ?>" 
                             style="height: 320px; border-radius: 30px 30px 0 0;">
                <p><?php echo e($movie->description); ?></p>
                <p>Director: <?php echo e($movie->director); ?></p>
                <p>Release Year: <?php echo e($movie->release_year); ?></p>
                <p>Genre: <?php echo e($movie->genre); ?></p>
            </div>
        </div>

        <!-- Add Review Button -->
        <div class="row mt-4">
            <a href="<?php echo e(url('/add_review/' . $movie->id)); ?>" class="btn btn-primary">Add Review</a>
            <!-- <a href="/add_review/<?php echo e($movie->id); ?>" class="btn btn-primary">Add Review</a> -->
        </div>

        <!-- Rating -->
        <div class="row mt-4">
            <div class="rating">
                <h3>Rating</h3>
                <?php
                    $totalRating = 0;
                    $reviewCount = count($reviews);
                    foreach ($reviews as $review) {
                        $totalRating += $review->rating;
                    }
                    $averageRating = $reviewCount > 0 ? $totalRating / $reviewCount : 0;
                ?>
                <h3><?php echo e(number_format($averageRating, 1)); ?>/5</h3>
            </div>
        </div>

        <!-- User Reviews -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h2>User Reviews (<?php echo e($reviewCount); ?>)</h2>
                <div id="reviewsContainer">
                    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card-review mb-3">
                            <div class="card-body-review">
                                <h5 class="card-title-review"><?php echo e($review->author); ?> - Rating: <?php echo e($review->rating); ?>/5</h5>
                                <p class="card-text-review"><?php echo e($review->review_text); ?></p>
                                <small>Reviewed on: <?php echo e(\Carbon\Carbon::parse($review->created_at)->format('M d, Y')); ?></small>
                                <form action="<?php echo e(url("delete_review/$review->id")); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <button type="submit" class="btn btn-primary">Delete review</button>
                                    <a href="<?php echo e(url("edit_review/$review->id")); ?>" class="btn btn-primary">Edit</a>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /var/www/html/Assignment1/blank/resources/views/movie.blade.php ENDPATH**/ ?>