<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directors</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mt-5">
        <h1>Directors Collection</h1>

        <div class="row mt-4">
            <?php $__currentLoopData = $directors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $director): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <!-- Director Image (if available) -->
                        
                        <div class="card-body">
                            <h3 class="director">
                                <a class="view-movies" href="/directors/<?php echo e(urlencode($director->director)); ?>/movies">
                                    <?php echo e($director->director); ?>

                                </a>
                            </h3>
                            <p><strong>Movies Directed:</strong> <?php echo e($director->movieCount); ?></p>
                            <a href="<?php echo e(url('directors/' . urlencode($director->director) . '/movies')); ?>" class="btn btn-secondary">View Movies</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</body>
</html>
<?php /**PATH /var/www/html/Assignment1/blank/resources/views/directors.blade.php ENDPATH**/ ?>