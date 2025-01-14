<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($director); ?> Movies</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Display all movies specific to the particular director -->
    <div class="container mt-5">
        <h1><?php echo e($director); ?> Collection</h1>
            <div class="row mt-4">
                <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                        <img src="<?php echo e(asset('assets/images/movies/movie' . $movie->id . '.jpg')); ?>" 
                             alt="Movie poster for <?php echo e($movie->title); ?>" 
                             style="height: 320px; border-radius: 30px 30px 0 0;">

                            <!-- Movie Details -->
                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($movie->title); ?></h5>
                                <p><strong>Rating:</strong> <?php echo e(number_format($movie->averageRating, 1)); ?>/5 (<?php echo e($movie->reviewCount); ?> reviews)</p>
                                <p class="card-text"><?php echo e(Str::limit($movie->description, 150, '...')); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
    </div>
</body>
</html>
<?php /**PATH /var/www/html/Assignment1/blank/resources/views/director.blade.php ENDPATH**/ ?>