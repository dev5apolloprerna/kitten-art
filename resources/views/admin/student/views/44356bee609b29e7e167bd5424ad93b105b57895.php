<!DOCTYPE html>
<html lang="en">


<?php echo $__env->make('common.fronthead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body id="page-top">

    <div class="page-wrapper">


        <?php echo $__env->make('common.frontheader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->make('common.frontfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



        <?php echo $__env->make('common.frontfooterjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('scripts'); ?>
    </div>
</body>

</html><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/layouts/front.blade.php ENDPATH**/ ?>