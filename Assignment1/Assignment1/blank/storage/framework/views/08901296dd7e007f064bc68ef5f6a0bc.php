<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Movie</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
    <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mt-5">
        <form action="<?php echo e(url('add_movie')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>


            <div class="mb-3">
                <label for="title" class="form-label">Movie Title:</label><br>
                <input type="text" class="form-control" name="title" placeholder="Enter movie title" required>
                <?php if($errors->has('title')): ?>
                    <span class="text-danger"><?php echo e($errors->first('title')); ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="director" class="form-label">Director:</label><br>
                <input type="text" class="form-control" name="director" placeholder="Enter director name" required>
                <?php if($errors->has('director')): ?>
                    <span class="text-danger"><?php echo e($errors->first('director')); ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="release_year" class="form-label">Release Year:</label><br>
                <input type="text" class="form-control" name="release_year" placeholder="Enter release year" required>
                <?php if($errors->has('release_year')): ?>
                    <span class="text-danger"><?php echo e($errors->first('release_year')); ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Genre:</label><br>
                <input type="text" class="form-control" name="genre" placeholder="Enter genre" required>
                <?php if($errors->has('genre')): ?>
                    <span class="text-danger"><?php echo e($errors->first('genre')); ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label><br>
                <textarea class="form-control" name="description" rows="4" placeholder="Write movie description here" required></textarea>
                <?php if($errors->has('description')): ?>
                    <span class="text-danger"><?php echo e($errors->first('description')); ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="poster" class="form-label">Movie Poster:</label><br>
                <input type="file" class="form-control" name="poster" required>
                <?php if($errors->has('poster')): ?>
                    <span class="text-danger"><?php echo e($errors->first('poster')); ?></span>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
<?php /**PATH /var/www/html/Assignment1/blank/resources/views/add_movie.blade.php ENDPATH**/ ?>