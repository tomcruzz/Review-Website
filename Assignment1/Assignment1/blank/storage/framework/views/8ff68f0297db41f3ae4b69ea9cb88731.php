<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
    <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mt-5">
        <h1>Edit Review for Movie: <?php echo e($review->movie->title); ?></h1>
        <form action="<?php echo e(url('update_review/' . $review->id)); ?>" method="POST">
            <?php echo e(csrf_field()); ?>

            <div class="mb-3">
                <label for="author" class="form-label">Name:</label>
                <input type="text" class="form-control" name="author" value="<?php echo e(old('author', $review->author)); ?>" required>
                <?php if($errors->has('author')): ?>
                    <span class="text-danger"><?php echo e($errors->first('author')); ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">Rating:</label>
                <input type="number" class="form-control" name="rating" min="1" max="5" value="<?php echo e(old('rating', $review->rating)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="review_text" class="form-label">Review:</label>
                <textarea class="form-control" name="review_text" rows="4"><?php echo e(old('review_text', $review->review_text)); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Review</button>
        </form>
    </div>
</body>
</html>
<?php /**PATH /var/www/html/Assignment1/blank/resources/views/edit_review.blade.php ENDPATH**/ ?>