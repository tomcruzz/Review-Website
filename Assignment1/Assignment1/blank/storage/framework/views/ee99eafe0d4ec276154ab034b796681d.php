<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mollywood Movies</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
    <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mt-5">
        <div class="row">
            <div>
                <h1 class="text-start">Find out the best-rated Malayalam movies!</h1>
                <p class="text-start">Movies:</p>
            </div>
        </div>

        <!-- Sort Section -->
        <div class="row mt-3">
            <form method="GET" action="<?php echo e(url('/')); ?>" class="form-inline">
                <label for="sort" class="mr-2">Sort by:</label>
                <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                    <option value="title" <?php echo e(request('sort') == 'title' ? 'selected' : ''); ?>>Title</option>
                    <option value="review_count" <?php echo e(request('sort') == 'review_count' ? 'selected' : ''); ?>>Number of Reviews</option>
                    <option value="average_rating" <?php echo e(request('sort') == 'average_rating' ? 'selected' : ''); ?>>Average Rating</option>
                </select>
            </form>
        </div>

        <!-- Movies section -->
        <div class="row mt-4">
            <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="card">
                        
                    <img src="<?php echo e(asset('assets/images/movies/movie' . $movie->id . '.jpg')); ?>" 
                             alt="Movie poster for <?php echo e($movie->title); ?>" 
                             style="height: 320px; border-radius: 30px 30px 0 0;">
                        
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($movie->title); ?></h5>
                            <p><strong>Rating:</strong> <?php echo e(number_format($movie->averageRating, 1)); ?>/5 (<?php echo e($movie->reviewCount); ?> reviews)</p>
                            <p class="card-text"><?php echo e($movie->description); ?></p>
                            <div class="row-display">
                                <a href="<?php echo e(url('movie/' . $movie->id)); ?>" class="btn btn-secondary">More</a>
                                <!-- <a href="<?php echo e(url('add_review/' . $movie->id)); ?>" class="btn btn-secondary">More</a> -->
                                <form action="<?php echo e(url("delete_movie/$movie->id")); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <button type="submit" class="btn btn-danger delete">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Add Movie Button -->
        <a href="<?php echo e(url('add_movie')); ?>" class="btn btn-primary add-movie">Add Movie</a>
    </div>
</body>
</html>
<?php /**PATH /var/www/html/Assignment1/blank/resources/views/home.blade.php ENDPATH**/ ?>