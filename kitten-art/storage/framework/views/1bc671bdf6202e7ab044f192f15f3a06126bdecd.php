<?php $__env->startSection('content'); ?>

  
<section class="section">

<div class="container">
    <div class="row">
        <div class="col-lg-6" style="align-content: center;">
            <h3>

                <?php     $data = session('data'); ?>

                <?php if(isset($data['service_id'])): ?>
                Thank You For Your <?php echo e($data['service_name']); ?> Registration With Kitten Art Classes. </h3>
                <p>We will get back to you soon...</p>

                <?php else: ?>
            Thank You For Your Free Trial Class Registration With Kitten Art Classes. </h3>
            <p>We will get back to you soon...</p>
            <?php endif; ?> 
        </div>
        <div class="col-lg-6">
            <img src="<?php echo e(asset('front/assets/images/thankyou.png')); ?>" />
        </div>
    </div>
</div>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/thankyou.blade.php ENDPATH**/ ?>