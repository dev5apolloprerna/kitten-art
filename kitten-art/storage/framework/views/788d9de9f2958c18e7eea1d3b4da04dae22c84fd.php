<?php $__env->startSection('content'); ?>
<style>
  .single-class .class-image img {
    transition: 0.5s;
    border-radius: 5px 5px 0 0;
    object-fit: cover;
    width: 100%;
    height: 250px;
}
</style>
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Terms And Conditions</h2>
                    <ul>
                        <li>
                            <a href="<?php echo e(route('FrontIndex')); ?>">Home</a>
                        </li>
                        <li>Terms And Conditions</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->

<section class="class-area bg-fdf6ed pt-100 pb-70">
      <div class="container">
        <div class="section-title">
          <span>Terms And Conditions</span>
          <h2>Our <?php echo e($data->name); ?></h2>
        </div>
        <div class="row">
        <p class="text-center">
        <?php echo $data->description; ?>

        </p>
        </div>
        </div>
      </div>
    </section>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/termandcondition.blade.php ENDPATH**/ ?>