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
                    <h2>Classes</h2>
                    <ul>
                        <li>
                            <a href="<?php echo e(route('FrontIndex')); ?>">Home</a>
                        </li>
                        <li>Classes</li>
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
          <span>Classes</span>
          <h2>Our Classes</h2>
        </div>
        <div class="row">
        <p class="text-center">
        Kitten art classes help kids to develop their motor skills, improve their confidence, develop more focus & improve memory. We have created weekly, unique art classes for kids ages 6-14 to keep your child entertained & creative. It will help them to keep away from screens. Kids will learn something new & innovative in our classes. <br><br>
        </p>
        </div>
        <div class="row">
          <?php $__currentLoopData = $plan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-lg-4 col-md-6">
            <div class="single-class">
              <div class="class-image">
                <a href="<?php echo e(route('FrontClassDetail',$data->planId)); ?>">
                  <img src="<?php echo e(asset($data['plan_image'] ? 'plan_image/' . $data['plan_image'] : 'images/noImage.png')); ?>" alt="image">
                </a>
              </div>
              <div class="class-content">
                <div class="price">$ <?php echo e($data->plan_amount); ?>  / <?php echo e($data->plan_session); ?> session</div>
                <h3>
                  <a href="#"><?php echo e($data->categoryName); ?> </a>
                </h3>

                <ul class="class-list"><li><h4><?php echo e($data->plan_name); ?></h4></li></ul>
                <p>
                  <?php echo Str::limit($data->plan_description, 200, '....'); ?>

                </p>
                
                <!-- <?php echo $data->plan_description; ?></p> -->
                <!--<ul class="class-list">-->
                <!--  <li> <span>Batch Name: </span><?php echo e($data->batchname); ?></li>-->
                   
                <!--  <li><span>Time: </span><?php echo e(date('h:i a',strtotime($data->batch_from_time))); ?> - <?php echo e(date('h:i a',strtotime($data->batch_to_time)) ?? '-'); ?> -->
                <!--  </li><br>-->
                <!--  <li>-->
                <!--    <span>sessions:</span> <?php echo e($data->plan_session); ?> -->
                <!--  </li>-->
                <!--</ul> -->
                <div class="class-btn">
                  <form method="post" action="<?php echo e(route('FrontRegistration')); ?>">
                    <?php echo csrf_field(); ?>
                      <input type="hidden" name="category_id" value="<?php echo e($data->category_id); ?>">
                      <input type="hidden" name="plan_id" value="<?php echo e($data->planId); ?>"> 
                      <input type="hidden" name="batch_id" value="<?php echo e($data->batch_id); ?>"> 
                       <a href="<?php echo e(route('FrontClassDetail',$data->planId)); ?>" class="default-btn btn" style="border:none;"> Details</a>
                  <button  type="submit" class="default-btn" style="border:none;">Join Class</button>
                 
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/class.blade.php ENDPATH**/ ?>